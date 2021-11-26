#!/bin/sh

export MC="-j$(nproc)"

echo "============================="
echo "install extensions from : install.sh"
echo "PHP version             : ${PHP_VERSION}"
echo "extensions              : ${PHP_EXTENSIONS}"
echo "multicore compilation   : ${MC}"
echo "directory               : ${PWD}"
echo "============================="

if [ ! ${PHP_EXTENSIONS} ]; then
    echo "======= Not PHP Extensions ======="
    exit
fi

apk --update add --no-cache --virtual .bauild-deps autoconf g++ make curl-dev gettext-dev linux-headers

handle() {

    apecial=

    for line in ${PHP_EXTENSIONS//,/' '}
    do

        if [ ${apecial} ]; then
            for ape in ${apecial//,/' '}
            do
                if [ "${line}" = "${ape}" ]; then
                    ${ape}
                    continue 2
                fi
            done
        fi
        

        echo "======= install ${line} ======="
        #docker-php-ext-install ${MC} ${line}
        install-php-extensions ${line}

    done

}

#
# Install extension from package file(.tgz),
# For example:
#
# installExtensionFromTgz swoole-4.8.2
#
# Param 1: Package name with version
# Param 2: enable options
#
installExtensionFromTgz()
{
    tgzName=$1
    extensionName="${tgzName%%-*}"

    mkdir ${extensionName}
    tar -xf ${tgzName}.tgz -C ${extensionName} --strip-components=1
    ( cd ${extensionName} && phpize && ./configure && make ${MC} && make install )

    docker-php-ext-enable ${extensionName} $2
}

handle
