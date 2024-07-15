CREATE DATABASE IF NOT EXISTs pstage;
USE pstage;

CREATE TABLE Roles (
id INT(255) AUTO_INCREMENT PRIMARY KEY,
role_name VARCHAR(50) NOT NULL,
descriptions VARCHAR(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;





CREATE TABLE users (
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    role_id INT(255) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR (70) NOT NULL,
    email VARCHAR (255) NOT NULL UNIQUE,
    pwd VARCHAR (50) NOT NULL,
    FOREIGN KEY (role_id) REFERENCES roles(id)
);

CREATE TABLE levels (
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    level_name VARCHAR(50) NOT NULL UNIQUE,
    statut VARCHAR(15) NOT NULL
)

CREATE TABLE sections(
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    created_by INT(255) NOT NULL,
    last_modified_by INT(255) NOT NULL,
    level_id  INT(255) NOT NULL,
    school_year VARCHAR (70) NULL,
    created_at TIMESTAMP DEFAULT current_timestamp(),
    statut VARCHAR(15) NOT NULL DEFAULT 'actif',
    deleted BOOLEAN NOT NULL DEFAULT false,
    FOREIGN KEY (created_by) REFERENCES users(id),
    FOREIGN KEY (last_modified_by) REFERENCES users(id),
    FOREIGN KEY (level_id) REFERENCES levels(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE students (
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    created_by INT(255) NOT NULL,
    last_modified_by INT(255) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR (70) NOT NULL,
    email VARCHAR (255) NOT NULL UNIQUE,
    pwd VARCHAR (50) NOT NULL,
    created_at TIMESTAMP DEFAULT current_timestamp(),
    deleted BOOLEAN NOT NULL DEFAULT false,
    FOREIGN KEY (created_by) REFERENCES users(id),
    FOREIGN KEY (last_modified_by) REFERENCES users(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE programs (
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    created_by INT (255) NOT NULL,
    last_modified_by INT (255) NOT NULL,
    program_name VARCHAR (10) NOT NULL,
    descriptive VARCHAR (255),
    level_name  VARCHAR (25),
    duration VARCHAR(255) NOT NULL,
    deleted BOOLEAN  NOT NULL DEFAULT false,
    created_at TIMESTAMP DEFAULT current_timestamp(),
    FOREIGN KEY (created_by) REFERENCES users(id),
    FOREIGN KEY (last_modified_by) REFERENCES users(id)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE tuitions (
    id INT (255) AUTO_INCREMENT PRIMARY KEY,
    created_by INT (255) NOT NULL,
    last_modified_by INT (255) NOT NULL,
    program_id INT(255) NOT NULL,
    section_id INT(255) NOT NULL,
    program VARCHAR (255) NOT NULL,
    level_name  VARCHAR (25),
    amount FLOAT NOT NULL,
    created_at TIMESTAMP DEFAULT current_timestamp(),
    deleted BOOLEAN  NOT NULL DEFAULT false,
    FOREIGN KEY (created_by) REFERENCES Users(id),
    FOREIGN KEY (last_modified_by) REFERENCES users(id),
    FOREIGN KEY (program_id) REFERENCES programs(id),
    FOREIGN KEY (section_id) REFERENCES sections(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE Registrations(
     id INT (255) AUTO_INCREMENT PRIMARY KEY,
     student_id INT (255) NOT NULL,
     created_by INT(255) NOT NULL,
     last_modified_by INT(255) NOT NULL,
     created_at TIMESTAMP DEFAULT current_timestamp(),
     section_id INT(255) NOT NULL,
     program_id INT(255) NOT NULL,
     statut VARCHAR(15) NOT NULL DEFAULT 'en_cours',
     deleted BOOLEAN NOT NULL DEFAULT false,
     FOREIGN KEY (created_by) REFERENCES users(id),
     FOREIGN KEY (last_modified_by) REFERENCES users(id),
     FOREIGN KEY (student_id) REFERENCES students(id),
     FOREIGN KEY (section_id) REFERENCES sections(id),
     FOREIGN KEY (program_id) REFERENCES programs(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE payments (
    id INT (255) AUTO_INCREMENT PRIMARY KEY,
    created_by INT(255) NOT NULL,
    last_modified_by INT(255) NOT NULL,
    registration_id INT(255) NOT NULL,
    amount FLOAT (25) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT current_timestamp(),
    deleted BOOLEAN  NOT NULL DEFAULT false,
    FOREIGN KEY (created_by) REFERENCES users(id),
    FOREIGN KEY (last_modified_by) REFERENCES users(id),
    FOREIGN KEY (registration_id) REFERENCES registrations(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;









