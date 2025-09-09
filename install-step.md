# SQL Injection Exploitation vs Secure Coding -- Installation & Deployment Guide

## 1. Project Overview

This project demonstrates how SQL Injection vulnerabilities can be
exploited and how prepared statements mitigate the risk.

**Pages:** - `page1.html` + `page1.php` -- Vulnerable to SQL Injection -
`page2.html` + `page2.php` -- Secure with ModSecurity WAF

## 2. Prerequisites

-   AWS account
-   AMI: Ubuntu Server 22.04 LTS
-   Public IP: **3.87.88.51**

## 3. Launch EC2 Instance

1.  Go to EC2 → Launch Instance → Select **Ubuntu Server 22.04 LTS**
    AMI.
2.  Instance Type: `t2.micro` (or `t3.small` for better performance).
3.  Storage: Default 8 GB is fine.
4.  Security Group: Allow inbound:
    -   SSH (TCP 22) -- your IP only
    -   HTTP (TCP 80) -- 0.0.0.0/0
    -   HTTPS (TCP 443)
5.  Create/use `.pem` key pair and store securely.
6.  Launch instance → Note public IPv4: **3.87.88.51**

## 4. SSH Access

``` bash
chmod 400 ~/Downloads/mykey.pem
ssh -i ~/Downloads/mykey.pem ubuntu@3.87.88.51
```

## 5. System Preparation

``` bash
sudo apt update && sudo apt upgrade -y
sudo apt install -y apache2 php libapache2-mod-php php-mysql mysql-server git wget curl libapache2-mod-security2
sudo systemctl enable --now apache2
sudo systemctl enable --now mysql
```

## 6. Database Setup

``` sql
sudo mysql -u root
CREATE DATABASE appdb;
USE appdb;
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL
);
INSERT INTO users (username, password) VALUES
('admin', 'admin123'),
('testuser', 'testpass'),
('john', 'doe123');
```

## 7. Deploy Web Application Files

Create the following in `/var/www/html/`:

-   **page1.html** (Vulnerable)
-   **page1.php** (Vulnerable)
-   **page2.html** (Secure)
-   **page2.php** (Secure)

Set permissions:

``` bash
sudo chown -R www-data:www-data /var/www/html
sudo chmod -R 755 /var/www/html
```

## 8. Install & Configure ModSecurity + OWASP CRS

``` bash
sudo mkdir -p /usr/share/modsecurity-crs
sudo git clone https://github.com/coreruleset/coreruleset.git /usr/share/modsecurity-crs
sudo cp /usr/share/modsecurity-crs/crs-setup.conf.example /usr/share/modsecurity-crs/crs-setup.conf
sudo cp /etc/modsecurity/modsecurity.conf-recommended /etc/modsecurity/modsecurity.conf
sudo sed -i 's/SecRuleEngine DetectionOnly/SecRuleEngine On/' /etc/modsecurity/modsecurity.conf
```

### Apache ModSecurity Configuration

Edit `/etc/apache2/mods-enabled/security2.conf`:

``` apache
<IfModule security2_module>
    SecDataDir /var/cache/modsecurity
    IncludeOptional /etc/modsecurity/*.conf
    IncludeOptional /usr/share/modsecurity-crs/crs-setup.conf
    IncludeOptional /usr/share/modsecurity-crs/rules/*.conf
    IncludeOptional /etc/modsecurity/rules/*.conf
    IncludeOptional /etc/modsecurity/disable-page1.conf
</IfModule>
```

## 9. Local Rules & Exceptions

Create directory:

``` bash
sudo mkdir -p /etc/modsecurity/rules
```

### Add Local Rule `/etc/modsecurity/rules/local_rules.conf`

``` apache
SecRule ARGS|ARGS_NAMES|REQUEST_HEADERS|REQUEST_COOKIES "@rx (?i:(\b(select|union|insert|update|delete|drop|truncate|exec|declare)\b|\-\-|;|/\*|\*/|char\(|concat\(|information_schema|sleep\())"   "id:900100,phase:2,deny,log,status:403,msg:'Local SQLi protection: possible SQLi attempt'"
```

### Disable ModSecurity for page1 `/etc/modsecurity/disable-page1.conf`

``` apache
<IfModule security2_module>
  <LocationMatch "/page1.php">
    SecRuleEngine Off
  </LocationMatch>
</IfModule>
```

## 10. Restart & Verify

``` bash
sudo systemctl restart apache2
sudo systemctl status apache2
sudo systemctl status mysql
apachectl -M | grep security2
```

## 11. Testing

### Vulnerable Page (page1)

``` bash
curl -v -X POST -d "username=' OR '1'='1' --&password=x" http://3.87.88.51/page1.html
# Expected: Login success
```

### Secure Page (page2)

``` bash
curl -v -X POST -d "username=' OR '1'='1' --&password=x" http://3.87.88.51/page2.html
# Expected: Forbidden
#You don't have permission to access this resource.


```
