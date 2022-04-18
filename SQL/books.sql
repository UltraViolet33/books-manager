CREATE TABLE categories (
    categories_id INTEGER NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    PRIMARY KEY (categories_id)
);

CREATE TABLE books (
    books_id INTEGER NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    isRead TINYINT(1) DEFAULT 0,
    PRIMARY KEY (books_id)
);

CREATE TABLE books_categories(
    books_id INTEGER NOT NULL,
    categories_id INTEGER NOT NULL,
    PRIMARY KEY (books_id, categories_id),
    CONSTRAINT fk_books
        FOREIGN KEY (books_id)
        REFERENCES books (books_id)
        ON UPDATE CASCADE,
    CONSTRAINT fk_categories
        FOREIGN KEY(categories_id)
        REFERENCES categories (categories_id)
        ON UPDATE CASCADE,
);