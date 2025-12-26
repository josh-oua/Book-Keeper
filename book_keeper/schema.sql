DROP DATABASE IF EXISTS book_keeper;
CREATE DATABASE book_keeper CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE book_keeper;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_no VARCHAR(20) NOT NULL UNIQUE,
  name VARCHAR(100) NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE books (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(200) NOT NULL,
  author VARCHAR(150) NOT NULL,
  category VARCHAR(100) NOT NULL,
  isbn VARCHAR(20),
  status ENUM('available','unavailable') NOT NULL DEFAULT 'available',
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE borrowings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  book_id INT NOT NULL,
  request_date DATE NOT NULL,
  start_date DATE,
  due_date DATE,
  return_date DATE,
  status ENUM('requested','borrowed','returned','cancelled') NOT NULL DEFAULT 'requested',
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_borrow_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  CONSTRAINT fk_borrow_book FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE
);

INSERT INTO books (title, author, category) VALUES
('Introduction to Algorithms', 'Cormen, Leiserson, Rivest, Stein', 'Computer Science'),
('Clean Code', 'Robert C. Martin', 'Software Engineering'),
('Database System Concepts', 'Silberschatz, Korth, Sudarshan', 'Information Management'),
('You Don’t Know JS', 'Kyle Simpson', 'Web Development'),
('Operating System Concepts', 'Silberschatz, Galvin, Gagne', 'Computer Science'),
('Design Patterns', 'Gamma, Helm, Johnson, Vlissides', 'Software Engineering');

