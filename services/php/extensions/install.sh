#!/bin/sh

export MC="-j$(nproc)"

echo "============================="
echo "install extensions from : install.sh"
echo "PHP version             : ${PHP_VERSION}"
echo "extensions              : ${PHP_EXTENSIONS}"
echo "multicore compilation   : ${MC}"
echo "directory               : ${PWD}"
echo "============================="

if [ "${PHP_EXTENSIONS}" != "" ]; then
    apk --update add --no-cache --virtual .bauild-deps autoconf g++ make curl-dev gettext-dev linux-headers
fi

handle() {

    for line in ${PHP_EXTENSIONS//,/' '}
    do
        echo "======= install ${line} ======="
        docker-php-ext-install ${MC} ${line}
    done

}

handle
