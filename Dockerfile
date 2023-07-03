# Pull base image
FROM ubuntu:22.04

# Set noninteractive environment
ENV DEBIAN_FRONTEND=noninteractive

# Install necessary packages
RUN apt-get update && \
    apt-get install -y apache2 php libapache2-mod-php php-mysql mysql-client openssh-server&& \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Copy source code to apache document root
COPY board /var/www/html/
RUN echo "SSF{THIS_IS_FAKE_FLAG}" > /flag

# Enable apache rewrite module
RUN a2enmod rewrite

# Change owner and group for the html directory
RUN rm /var/www/html/index.html
RUN chown -R www-data:www-data /var/www/html

# sshd service setting
RUN echo 'root:root' | chpasswd # need change
RUN mkdir /var/run/sshd
RUN chmod 0755 /var/run/sshd   # /var/run/sshd 권한 변경
RUN sed -i 's/#PermitRootLogin prohibit-password/PermitRootLogin yes/' /etc/ssh/sshd_config
RUN service ssh start

# Expose port 80
EXPOSE 80

#make uploads directory
RUN mkdir -p /var/www/html/uploads

#give sudo to www-data
RUN apt-get update && apt-get install -y sudo
RUN echo "www-data ALL=(ALL) NOPASSWD:ALL" >> /etc/sudoers

# Start apache service
CMD exec /bin/bash -c "/etc/init.d/ssh start; /usr/sbin/apache2ctl -D FOREGROUND"

