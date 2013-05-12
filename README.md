FormTextSerial
==============

FormTextSerial takes the data entered in a form served on a Raspberry Pi and passes it to a text file. A script then passes that text to the Raspberry Pi serial. From there it is sent via RF using the RFM2Pi (including associated firmware).

The process is largely copied from the Emoncms Raspberry Pi installation and has been done to test sending data from a web browser through serial and RF.

It has been tested with the following setup:

<b>Hardware</b>
- Raspberry Pi (http://www.raspberrypi.org)
- RFM2Pi (http://harizanov.com/product/rfm2pi-board-v2/)

<b>Server Stack</b>

Install the elements below as per instructions at http://emoncms.org/site/docs/raspberrypibuild
- "2013-02-09-wheezy-raspbian" distro installed on Raspberry Pi
- Apache2
- php
- rfm12pi gateway service: PHP gateway - except instead of rfm12piphp use the form_script file
Ignore the emoncms and Mysql elements in the instructions list

<b>Code</b>
- Copy "index.php" & "form_run.php" to your "var/www/" folder
- Create a file called "share.txt" and ensure "www-data" can write to it

Reboot the system.
To determine the status of the script use "sudo service form_script status". Changing the word status with start, stop or restart will have the expected effect. See: https://github.com/emoncms/raspberrypi/commit/66293ecd746f4f0b8a74aaf2ff1fe587bd7780ad

<b>Known issues</b>

- Sometimes the input at the browser end is not transferres through to the RF. I think is because the form_script is not in the right part of it's loop when the index.php writes to the file....but don't know.
