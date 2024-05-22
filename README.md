RFID-Based Identification System with PHP and Arduino
This project implements an RFID-based identification system using an ESP8266 microcontroller, a RFID module, and PHP for backend management. The system is designed to log entries and exits, manage RFID tags, and alert users in case of suspicious activities.

Features
RFID Tag Detection and Logging:

When an RFID tag is detected, the system checks if the tag is registered in the database.
If registered, it logs the entry/exit with the user's name, surname, matricule, and timestamp.
If not registered, it prompts for the tag to be added to the database.
Tag Management:

Add new RFID tags to the system with user details.
Modify existing user details linked to an RFID tag.
Delete RFID tags from the system.
Log Management:

View logs of entries and exits for each RFID tag.
Filter logs by date and time to monitor specific periods.
Email Alerts:

Automatically send an email alert if a log is recorded at suspicious hours.
Hardware Requirements
ESP8266 microcontroller
RFID module (e.g., MFRC522)
RFID tags/cards
Power supply for the ESP8266
Breadboard and connecting wires
Software Requirements
PHP 7.0 or higher
MySQL or any other relational database
Web server (e.g., Apache)
Arduino IDE for programming the ESP8266
Installation and Setup
Hardware Setup:

Connect the RFID module to the ESP8266 following standard wiring diagrams for your specific RFID module.
Ensure the ESP8266 is powered properly and has access to Wi-Fi for database communication.
Backend Setup:

Set up a web server with PHP and MySQL support.
Clone this repository to your web server's root directory.
Import the provided database.sql file to set up the required tables in your database.
Configure the config.php file with your database credentials and email settings.
Programming the ESP8266:

Install the necessary libraries for the ESP8266 and RFID module in the Arduino IDE.
Upload the provided Arduino sketch to the ESP8266.
Ensure the ESP8266 can communicate with your PHP backend over Wi-Fi.
Usage
Tag Detection:

When an RFID tag is brought near the RFID module, the ESP8266 will check the tag against the database.
If the tag is registered, the system will log the event.
If the tag is not registered, the system will prompt to add the tag.
Managing Tags:

Use the web interface to add, modify, or delete RFID tags.
Update user details associated with each RFID tag as needed.
Monitoring Logs:

Access the logs via the web interface to monitor entries and exits.
Set up email alerts to notify you of any suspicious activity.

Contributing
Contributions are welcome! Please fork this repository and submit pull requests for any improvements or bug fixes.

License
This project is licensed under the MIT License. See the LICENSE file for more details.

Contact
For any questions or support, please contact me.

