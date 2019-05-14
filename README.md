# nePARK
#### Location Based Smart Parking Solution
<hr>

## About
__nePark__ is a system designed to address the problem of vehicle parking in busy cities with limited availability of parking space. It helps vehicle owners by helping to find the parking space nearest to his/her location.
<br>
This system has two parts. 
- A __web based platform__ for the owners of parking space (parking lot) to register their parking space into the system and to monitor the occupancy of theit parking lot.
- An __android application__ is provided to the vehicle owners to quickly locate a parking lot nearest to their current location. <a href="https://github.com/dependra50/NePark">See the Android Application repo</a>

## Working
> __The Android Application__

The application has a simple interface where the user provides the __radius__ within which he/she wants the parking lot to be.<br>
The user's __location__ is obtained from the GPS.<br>

Using these information, a search is performed to find a parking lot and the user is presented with a __list of all the parking lots__ that matches the search criteria. The list contains the following information about each of the item:
- Name of the Parking Lot
- Location of the Parking Lot
- Distance to reach the Parking Lot from user's current location.
- Rate of parking fee.
- Number of available parking spaces.*

*The number of available parking spaces is updated in real time through the web based platform.

Based on these information, the user selects one of the parking lot in the list after which he/she is provided with a __path__ to reach the parking lot from his/her current location using __google direction API__.

> __The Web based Platform__

This platform is designed for the owners of parking lot to manage the occupancy of their parking space. <br>
The owners of parking lot first register their parking lot to the system with information such as __name & location__ (latitude and longitude for accurate location) of the parking lot, __total number of spaces, rate of parking fee__ e.t.c.<br>
They then get an interface where they can monitor their parking lot. They can __check in__ and __check out__ vehicles. The number of available space for a parling lot in the database is updated with every check in/check out. This same database is used by the Android Application to provide real time number of free spaces to the users.

## Usage
> __Android__

Will be updated soon

> __The Web Platform__

The files and database should be hosted in  a server. The credentials in `mysqli_connect.php` file should be changed as per the setup.
