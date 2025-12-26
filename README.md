Submitted by: 

Joshua A. Calalo	- BSCS 2B


-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Introduction:

  The Book Keeper System is a digital library record platform designed specifically for the College of Computer Studies. Its primary purpose is to help students efficiently monitor the books they borrow and return from the department library. Before leaving the library, students are required to log in to their accounts to validate each borrowing transaction. This process ensures accountability, maintains accurate records of borrowed materials, and provides a reliable way to track library usage. By implementing this system, the department can safeguard resources while offering students a seamless and organized borrowing experience.


-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------

$host = 'localhost';
$db   = 'book_keeper';
$user = 'root';
$pass = '';

http://localhost/book_keeper/frontend/login.html

-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Entity-Relationtionship Diagram:

<img width="637" height="376" alt="image" src="https://github.com/user-attachments/assets/8346de37-e7f3-4b56-9134-1ff28073ddba" />

<img width="663" height="194" alt="image" src="https://github.com/user-attachments/assets/9fd23d44-9bf8-460b-b608-4b437d8264ad" />


-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Web Interfaces:


<img width="975" height="686" alt="image" src="https://github.com/user-attachments/assets/5e1444a3-5a24-4a8c-a871-6e744cf82584" />

1. Login Page
  
Purpose: Validates student identity before borrowing or returning books.

Features:

-	Secure login form requiring Student Number and Password.
-	Error handling with clear messages:
  	-	Student Number must be integers only.
  	-	Password must be at least 8 characters long.
- Redirects to the Dashboard after successful login.


<img width="975" height="682" alt="image" src="https://github.com/user-attachments/assets/48d2063f-48e5-4717-b799-36b46b9280d0" />

2. Register Page
   
Purpose: Allows students to create a new account in the system.
   
Features:

-	Registration form with required fields:
- Student Number (numeric validation).
	- Full Name.
  - Password (minimum 8 characters, secure input).
  - Confirm Password (must match).
-	Input validation with error messages for incorrect or incomplete entries.
-	Prevents duplicate accounts by checking if the Student Number or Email already exists.
-	Redirect to the Login Page after successful registration.
  

<img width="975" height="680" alt="image" src="https://github.com/user-attachments/assets/6f84e06b-d8fe-40f1-9536-59e7ae3cc419" />

3. Home Page

Purpose: Serves as the introductory page of the system, presenting its Goals, Vision, and Mission to students. It sets the tone and communicates the values behind the Book Keeper platform.

Features:

-	Prominent banner section styled with the system’s branding (red background, white text).
-	Clear display of the Goals (e.g., accountability, transparency, ease of use).
-	Statement of the Vision (e.g., to provide a modern, reliable, and student friendly library monitoring system).
-	Statement of the Mission (e.g., to ensure every student’s borrowing activity is tracked accurately and responsibly).
-	Sidebar navigation for quick access to other pages (Home, View Books, Borrowed and Returned lists).
-	Optional hover effects (e.g., subtle red glow) to highlight the Goals, Vision, and Mission sections for interactivity.


<img width="975" height="681" alt="image" src="https://github.com/user-attachments/assets/8175d458-a16b-4c1a-ad6b-236e554b1513" />

4. View Books Page

Purpose: Displays the complete list of books related to the College of Computer Studies courses, allowing students to browse available titles and initiate borrowing.

Features:

Book Catalog Grid:

-	Each book is shown as a card with cover image, title, and the author.
-	Cards are styled consistently with rounded corners and subtle shadows for clarity.

Hover Interaction:

-	When the mouse hovers over a book card, a “Borrow” button appears.
-	This button is hidden by default to keep the interface clean, only showing on hover for interactivity.


<img width="975" height="683" alt="image" src="https://github.com/user-attachments/assets/75de730a-0d28-4b58-a6f1-143d1211a0a9" />

Borrow Button Functionality:

-	Clicking the button opens a modal window where the student must:
	-	Select the borrow date (automatically filled with the current date).
	-	Specify the duration in days.
	-	Enter their account password to confirm the transaction
		
-	The system performs a session validation to ensure the student is logged in and authorized.
-	Borrowed books are automatically added to the student’s Borrowed Books Page.


<img width="975" height="681" alt="image" src="https://github.com/user-attachments/assets/8ba8356d-f075-4ad9-a3c0-1dae19f0b20e" />

5. Borrow Page

Purpose: Displays the list of books currently borrowed by the student, along with the date of borrowing. It also provides a secure way to initiate the return process for each book.

Features:

Borrowed Books List:

- Each entry includes the book cover, title, author, and borrow date.
-	Styled consistently with card layout for clarity and visual appeal.

Hover Interaction:

-	When the mouse hovers over a book card, a “Return” button appears.
-	Same with the Borrow Page.


<img width="975" height="687" alt="image" src="https://github.com/user-attachments/assets/c3f8107c-900d-4c4f-93df-fc0a22d23bba" />

Return Button Functionality:

-	Clicking the “Return” button on a borrowed book opens a modal window.
	-	Inside the modal, the student must:
 	-	Confirm the return date (automatically filled with the current date).
  -	Enter their account password to validate the transaction.
  
- The system performs a session validation to ensure the student is logged in and authorized.

Upon successful validation:

- The book is marked as returned in the system.
- The transaction is recorded in the student’s Returned Books Page.

<img width="975" height="681" alt="image" src="https://github.com/user-attachments/assets/6e760215-77c6-4a67-95b5-0d3ac1fe764f" />

6. Return Page

Purpose: Displays a complete list of books that the student has successfully returned to the library. This page serves as a historical record for accountability and reference.

Features:

Each entry includes:

-	Book cover
-	Title
-	Return date (timestamped for verification)

- Cards are styled consistently with the borrowed list for visual continuity.
- Read-Only Display: No action buttons are shown — books listed here are already returned.

Navigation Integration:

- Sidebar highlights the RETURNED section in red when active.
- Students can easily switch between Borrowed and Returned views.

-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Challenges and Learning:

Getting the layout to look clean and consistent was another big challenge. The sidebar, the book grid, the buttons — they all had to line up just right, and early versions looked messy or uneven. I spent a lot of time reorganizing CSS, removing duplicates, and experimenting with grid and flexbox until everything felt balanced. It taught me that design isn’t just about making things “work” — it’s about making them feel comfortable and intuitive for the user. That lesson stuck with me.
