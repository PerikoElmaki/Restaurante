INSERT INTO
    productos (nombre, categoria, precio, stock)
VALUES
    -- bebidass
    ('Acqua Naturale', 'bebidas', 1.50, 100),
     ('Acqua frizzante', 'bebidas', 1.50, 100),
     ('Coca Cola', 'bebidas', 2.00, 100),
     ('Fanta Arancia', 'bebidas', 2.00, 100),
     ('Moretti bottiglia', 'bebidas', 2.50, 100),
     ('Piccola birra', 'bebidas', 1.50, 100),
     ('Bicchiere di Vino Rosso', 'bebidas', 3.50, 50),
     ('Bicchiere di Vino Bianco', 'bebidas', 3.50, 50),
    -- Entrantes
    ('Speck', 'Entrante', 10.20, 50),
    ('Tagliere di formaggi', 'Entrante', 14.20, 50),
    ('Focaccia', 'Entrante', 7.00, 50),
    ('Provolone', 'Entrante', 8.50, 50),
    ('Affettati misti', 'Entrante', 20.00, 50),
    ('Pane all aglio', 'Entrante', 3.50, 50),

    -- Ensaladas
    ('Insalata César', 'Ensalada', 9.50, 50),
    ('Insalata Caprese', 'Ensalada', 8.00, 50),
    ('Insalata di burrata', 'Ensalada', 12.00, 50),
    ('Insalata di Rucola', 'Ensalada', 7.00, 50),
    -- Pastas
    ('Spaghetti Carbonara', 'Pasta', 9.50, 50),
    ('Lasagna', 'Pasta', 17.00, 50),
    ('Rigatoni', 'Pasta', 12.00, 50),
    ('Tagliatelle Puttanesca', 'Pasta', 14.00, 50),
    ('Ravioli agli Spinaci', 'Pasta', 9.00, 50),
    ('Fettuccine Alfredo', 'Pasta', 9.50, 50),
    ('Paccheri pistacchio', 'Pasta', 16.50, 50), 
    
    ('Margherita', 'Pizza', 8.00, 50), 
    ('Pepperoni', 'Pizza', 12.00, 50), 
    ('Zucca speck', 'Pizza', 17.50, 50),  
    ('P. Al tartufo', 'Pizza', 14.50, 50),
    ('Quattro Formaggi', 'Pizza', 14.50, 50), 
    ('Carbonara', 'Pizza', 20.00, 50), 
    ('Vegetariana', 'Pizza', 10.50, 50), 
    ('Funghi Porcini', 'Pizza', 17.50, 50),  

    ('Tiramisù', 'Postre', 5.00, 50), 
    ('Panna Cotta', 'Postre', 4.50, 50), 
    ('Gelato', 'Postre', 4.00, 50), 
    ('Cannoli', 'Postre', 4.50, 50), 
    ('Torta al Limone', 'Postre', 5.00, 50);




 
INSERT INTO `mesas` (`codigo`, `estado`) VALUES
('1', 0),
('2', 0),
('3', 0),
('4', 0),
('5', 0),
('6', 0),
('7',0), 
('8',0), 
('9',0);


INSERT INTO `camareros` (`id`, `nombre`, `contraseña`, `dni`, `foto`, `encargado`) VALUES
(1, 'Admin', 'admin', '11111111E', '11111111E.jpg', 1),
(2, 'maricon', 'gay', '2222222G', '2222222G.jpg', 0),
(3, 'Rosa Melano', 'rosa', '33333333A', 'rosa.jpg', 0),
(6, 'Pedro', 'redy', '48748246E', '48748246E.jpg', 0);