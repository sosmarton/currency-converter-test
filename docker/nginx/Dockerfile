FROM nginx:alpine

#RUN apk update
#RUN apk upgrade
#RUN apk add tzdata
#RUN echo "Europe/Berlin" > /etc/timezone
RUN set -x ; \
addgroup -g 82 -S www-data ; \
adduser -u 82 -D -S -G www-data www-data && exit 0 ; exit 1