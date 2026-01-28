CREATE TABLE users (
  id SERIAL PRIMARY KEY,
  fullname VARCHAR(255) NOT NULL,
  email VARCHAR(255) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  role VARCHAR(50) DEFAULT 'user',
  location VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE questions (
      id SERIAL PRIMARY KEY,
      titre VARCHAR(255) NOT NULL,
      description TEXT NOT NULL,
      user_id INTEGER NOT NULL,
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      CONSTRAINT fk_user_question FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE reponses (
   id SERIAL PRIMARY KEY,
   question_id INTEGER NOT NULL,
   user_id INTEGER NOT NULL,
   content TEXT NOT NULL,
   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   CONSTRAINT fk_question_reponse FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE,
   CONSTRAINT fk_user_reponse FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE favoris (
 id SERIAL PRIMARY KEY,
 user_id INTEGER NOT NULL,
 question_id INTEGER NOT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 CONSTRAINT fk_user_favoris FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
 CONSTRAINT fk_question_favoris FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE,
 UNIQUE(user_id, question_id)
);
