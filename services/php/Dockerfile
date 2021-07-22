ARG PHP_VERSION
FROM ${PHP_VERSION}

ARG TZ
ARG PHP_EXTENSIONS
ARG CONTAINER_PACKAGE_URL

RUN if [ $CONTAINER_PACKAGE_URL ] ; then sed -i "s/dl-cdn.alpinelinux.org/${CONTAINER_PACKAGE_URL}/g" /etc/apk/repositories ; fi

COPY ./extensions /tmp/extensions
WORKDIR /tmp/extensions
RUN chmod +x install.sh \
    && sh install.sh \
    && rm -rf /tmp/extensions

ADD ./extensions/install-php-extensions /usr/local/bin/

RUN chmod uga+x /usr/local/bin/install-php-extensions

# refer：https://game404.github.io/post/docker-timezone/
RUN apk --no-cache add tzdata \
    && cp "/usr/share/zoneinfo/$TZ" /etc/localtime \
    && echo "$TZ" > /etc/timezone

WORKDIR /www
