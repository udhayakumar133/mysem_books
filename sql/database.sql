CREATE DATABASE IF NOT EXISTS old_book_sales;

USE old_book_sales;

CREATE TABLE IF NOT EXISTS login_details
(
    u_name VARCHAR(50) NOT NULL,
    u_email VARCHAR(50) PRIMARY KEY,
    u_password varchar(20) NOT NULL,
    u_phoneno INT(10),
    u_joined_year INT(4),
    u_photo TEXT default "D:\xampp\htdocs\old_books_project\images\default-profile-pic.jpg"
);

CREATE TABLE IF NOT EXISTS book_details
(
    book_id int auto_increment,
    u_email varchar(50) not null,
    book_name text not null,
    book_author text not null,
    price int not null,
    catagory varchar(50) not null,
    book_image text default "H:\xampp\htdocs\MY\images\default-book-image.png",
    is_ordered varchar(50) default "not ordered",
    primary key(book_id),
    foreign key (u_email) REFERENCES login_details(u_email)
);

alter table book_details
add book_description text not null;

CREATE TABLE IF NOT EXISTS book_link_details
(
    book_link_id int auto_increment,
    u_email varchar(50) not null,
    link_book_name text not null,
    link_book_author text not null,
    link_book_catagory varchar(50) not null,
    link_book_link varchar(100) not null,
    primary key(book_link_id),
    foreign key (u_email) REFERENCES login_details(u_email)
);

alter table book_link_details
add link_book_description text not null;

CREATE TABLE IF NOT EXISTS order_table
(
    order_id int PRIMARY KEY auto_increment,
    owner_email varchar(50) NOT NULL,
    book_id int ,
    customer_email varchar(50) NOT NULL,
    order_time timestamp NOT NULL,
    foreign key (customer_email) REFERENCES login_details(u_email)
);

-- Adding foreign key
alter table order_table
add constraint foreign key(book_id) REFERENCES book_details(book_id);

-- Adding foreign key
alter table order_table 
add constraint foreign key(owner_email) REFERENCES login_details(u_email);

