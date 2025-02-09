CREATE TABLE Tarefas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    custo DECIMAL(10, 2) NOT NULL,
    data_limite DATE NOT NULL,
    ordem_apresentacao INT UNIQUE NOT NULL,
    comentarios TEXT
);
