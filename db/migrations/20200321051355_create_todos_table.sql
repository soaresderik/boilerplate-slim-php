-- migrate:up
create table todos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    title VARCHAR(100),
    `description` VARCHAR(255),
    `status` ENUM("OPEN", "IN_PROGRESS", "DONE") DEFAULT "OPEN",
    created_at TIMESTAMP DEFAULT NOW(),
    updated_at TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users (id)
)

-- migrate:down
DROP TABLE todos;

