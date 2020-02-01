# freenom: freenom domain name renews automatically

[![Build Status](https://img.shields.io/badge/build-passed-brightgreen?style=for-the-badge)](https://scrutinizer-ci.com/g/luolongfei/freenom/build-status/master)
[![Php Version](https://img.shields.io/badge/php-%3E=7.1-brightgreen.svg?style=for-the-badge)](https://secure.php.net/)
[![Scrutinizer Code Quality](https://img.shields.io/badge/scrutinizer-9.07-brightgreen?style=for-the-badge)](https://scrutinizer-ci.com/g/luolongfei/freenom/?branch=master)
[![MIT License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=for-the-badge)](https://github.com/luolongfei/freenom/blob/master/LICENSE)

### Origin
As we all know, Freenom is the only merchant on the planet that provides free top-level domain names, but it needs to be renewed every year for up to one year at a time. Since I applied for a bunch of domain names, and not at the same time,
So I felt frustrated every time I renewed, so I wrote this automatic renewal script.

### Demo
![Email example](https://s2.ax1x.com/2020/01/31/139Rrd.png "Email content")

Regardless of the success or failure of the renewal or the execution of the script, you will receive emails from the program. In the case of a renewal success or failure email, the email will include the number of days that the domain name has not been renewed.
The email refers to the email style of the unregistered public account sent by WeChat.

### a
- Mailbox: For the sake of understanding, it is also called robot mailbox, which is used to send notification emails. Currently supports `Gmail`,` QQ mailbox` and `163 mailbox`. The program will automatically determine the type of sending mailbox and use the appropriate configuration. `Gmail` is recommended.
- Mailbox: Used to receive notification emails sent by robots. It is recommended to use `QQ Mailbox`. The only advantage of` QQ Mailbox` is that the message will pop up in `QQ` when the mail is received.
- VPS: Any server can be used. The system recommends `Centos7`, and the PHP version must be` php7.1` or above.
- No more

### Configure sending email
The following introduces the configuration of `Gmail`,` QQ mailbox`, and `163 mailbox`. You only need to look at the parts you need. Note that `QQ mailbox` and` 163 mailbox` both use the account plus authorization code to log in.
`Google Mail` Use your account and password to log in, please know. I also want to talk about it. For domestic mailboxes, you have to spend a dime to send a text message to the mailbox provider to get the authorization code.
#### Setting up Gmail
1.In `Settings> Forwarding and POP / IMAP`, tick
- Enable POP for all messages
- Enable IMAP

![gmailConfiguration01](https://s2.ax1x.com/2020/01/31/13tKsg.png "gmailConfiguration01")

Then save your changes.

2.Allow less secure applications

After logging into Google Mail, visit the[Google Permission Setting Interface](https://myaccount.google.com/u/2/lesssecureapps?pli=1&pageId=none) and enable the application that is not secure enough.

![gmail configuration 02](https://s2.ax1x.com/2020/01/31/1392KH.png "gmail configuration 02")

Also, if prompted
> Do not allow access to account

After logging in to Google Mail, go to [this interface of gmail](https://accounts.google.com/b/0/DisplayUnlockCaptcha) and click Allow. This situation is relatively rare.

*Email settings are now complete. You can happily configure this program* :)

### Configuration script
All operations are performed under Centos7 system, other Linux distributions are similar
#### Get the source code
```bash
$ mkdir -p / data / wwwroot / freenom
$ cd / data / wwwroot / freenom

# clone the repository source
$ git clone https://github.com/luolongfei/freenom.git ./
```

#### Configuration process
```bash
# Copy configuration file template
$ cp .env.example .env

# Edit configuration file
$ vim .env

# .env Each item in the file has a detailed description, which will not be repeated here. In short, you need to change all the items in it to your own. Note the format of the multi-account configuration:
# e.g. MULTIPLE_ACCOUNTS = '<account1> @ <password1> | <account2> @ <password2> | <account3> @ <password3>'
# Of course, if you only have a single account, you only need to configure FREEENOM_USERNAME and FREEENOM_PASSWORD. The configurations of single account and multiple accounts will be read together and duplicated.

# After editing, press "Esc" to return to the command mode, enter ": wq" and press Enter to save and exit. You will not use Google's editor to ask Google Uncle :)
```

#### Add scheduled task
#### Install crontabs and cronie
```bash
$ yum -y install cronie crontabs

# Verify if crond is installed and started
$ yum list cronie && systemctl status crond

# Verify that crontab is installed
$ yum list crontabs $$ which crontab && crontab -l
```

##### Open the task form and edit
```bash
$ crontab -e

# Task content is as follows
# The meaning of this task is to execute the run file under / data / wwwroot / freenom / at 9 AM every day
# Note that replace / data / wwwroot / freenom / with the path where your run file is located
00 09 * * * cd / data / wwwroot / freenom / && php run> / dev / null 2> & 1
```

##### Restart the crond daemon
```bash
$ systemctl restart crond
```
To check if `Scheduled Task` is normal, you can also add a temporary` Scheduled Task` to be executed after a few minutes to see if the task is executed.

*So far, all the configurations have been completed, let's verify if the whole process works* :)

#### Verification
You can first change the value of `noticeFreq` in` config.php` to 1 (that is, send an email notification each time), and then execute
```bash
$ cd / data / wwwroot / freenom / && php run
```
If nothing else, you will receive an email about the domain name.

If you encounter any problems or bugs, please mention [issues](https://github.com/luolongfei/freenom/issues). If freenom changes the algorithm and causes this project to fail,
Please mention [issues](https://github.com/luolongfei/freenom/issues) to inform me that I will fix it in time and maintain this project for a long time. Welcome star ~

### Donate

#### PayPal: [https://www.paypal.me/mybsdc](https://www.paypal.me/mybsdc)
> Every time you spend money, you're casting a vote for the kind of world you want .-- Anna Lappe

![Every time you spend your money, you are voting for the world you want. ](https://s2.ax1x.com/2020/01/31/13P8cF.jpg)

Open source does not seek profit, how many follow the fate ... star is also a kind of support.

### Author
- Main program and framework: [@luolongfei](https://github.com/luolongfei)
- English document: [@肖阿姨](#)

### Acknowledgements
- [PHPMailer](https://github.com/PHPMailer/PHPMailer/) (Mail sending function depends on this library)
- [guzzle](https://github.com/guzzle/guzzle) (Curl library)

### Open source agreement
[MIT](https://opensource.org/licenses/mit-license.php)