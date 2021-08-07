CREATE TABLE category (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(255),
    description varchar(1000),
    image varchar(255),
    PRIMARY KEY (ID)
) 

CREATE TABLE subcategory (
    id int NOT NULL AUTO_INCREMENT,
    lat float(10,6) NOT NULL,
    lng float(10,6),
    varchar(255) name,
    description varchar(1000),
    image varchar(255),
    categoryid int(20),
    image02 varchar(255),
    image03 varchar(255),
    PRIMARY KEY (ID)
) 


CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO `category`(`id`, `name`, `descriptions Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.`, `image`) VALUES 
    ('1','temples','all the temples','https://risingnepaldaily.com/banner_image/5ea0e5798a68e_pas.png'),
    ('2','hospital','all the hospital','https://media.istockphoto.com/photos/building-with-large-h-sign-for-hospital-picture-id1130389312?k=6&m=1130389312&s=612x612&w=0&h=qqIDfSODZ489SOMAdJUxTQt4uwd-2zagN_fi8t4-UeY='),
    ('3','resturants','all the resturant','https://upload.wikimedia.org/wikipedia/commons/thumb/e/ef/Restaurant_N%C3%A4sinneula.jpg/1200px-Restaurant_N%C3%A4sinneula.jpg'),
    ('4','bus stations','all the bus stations','https://upload.wikimedia.org/wikipedia/commons/6/6e/Bath_Bus_Station_First_66729_WX54XCO_42910_WX05RVU.jpg'),
    ('5','schools','all the schools','https://assets.publishing.service.gov.uk/government/uploads/system/uploads/image_data/file/111994/s960_EmptyClassroom.jpg'),
    ('6','guitar shop','all the guitar shop','https://nepmag.net/wp-content/uploads/2018/05/26230189_1830268730348306_3964558406324177448_n.jpg');


INSERT INTO `subcategory`(`id`, `lat`, `lng`, `name`, `description`, `image`, `categoryid`, `image02`, `image03`) VALUES 
    ('1','27.700125','85.314087','pashupatinath','descriptions of pashupatinath Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'https://www.welcomenepal.com/uploads/destination/top-5-shiva-temples-in-kathmandu-valley-nepal.jpeg','1','https://www.welcomenepal.com/uploads/destination/top-5-shiva-temples-in-kathmandu-valley-nepal.jpeg','https://risingnepaldaily.com/banner_image/5ea0e5798a68e_pas.png'),
    ('2','27.703260','85.432442','Changu Narayan','descriptions of Changu Narayan Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '','1','',''),
    ('3','27.904156','84.584419','Manakamana','descriptions of Manakamana', '','1','',''),
    ('4','27.777899','85.362442','Budhanilkantha', 'descriptions of Budhanilkantha','1','',''),
    ('5''28.816639','83.872032','muktinath temple','description of muktinath temple', '','1','','');




