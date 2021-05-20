# Table Users

create table `user`
(
    user_ID int auto_increment,
    forename varchar(255) not null,
    surname varchar(255) not null,
    email varchar(255) not null,
    password varchar(512) not null,
    location_ID int null,
    constraint User_pk
        primary key (user_ID)
);

create unique index User_Email_uindex
    on `user` (email);

# Table Location

create table `location`
(
    location_ID int auto_increment,
    user_ID int not null,
    street varchar(512) not null,
    street_number varchar(128) not null,
    postcode int not null,
    city varchar(512) not null,
    constraint User_pk
        primary key (location_ID)
);

# Table Order

create table `order`
(
    order_ID int auto_increment,
    product_ID int not null,
    discount int null,
    quantity int not null,
    constraint Order_pk
        primary key (order_ID)
);

# Table Checkout - "Bill/Rechnung"

create table `checkout`
(
    checkout_ID int auto_increment,
    user_ID int not null,
    tip int null,
    member_ID int null,
    constraint Checkout_pk
        primary key (checkout_ID)
);

# Table Checkout-Order

create table `checkout-Order`
(
    checkout_ID int not null,
    order_ID int not null
);

create unique index Checkout_Order_ID_uindex
    on `checkout-Order` (order_ID);

# Table Member

create table member
(
    member_ID int auto_increment,
    forename varchar(255) null,
    surname varchar(255) null,
    email varchar(255) not null,
    password varchar(512) not null,
    rights int null,
    constraint Member_pk
        primary key (member_ID)
);

create unique index Member_Email_uindex
    on member (email);

# Table Article

create table article
(
    article_ID int auto_increment,
    title varchar(512) null,
    content varchar(8192) not null,
    publish timestamp default CURRENT_TIMESTAMP not null,
    likes int default 0 not null,
    num_of_read int default 0 not null,
    constraint Article_pk
        primary key (article_ID)
);


# Table Member-Article

create table `member-article`
(
    member_ID int not null,
    article_ID int not null
);

# Table Product

create table product
(
    product_ID int auto_increment,
    name varchar(1024) not null,
    price int not null,
    discount int not null default 0 check ( discount between 0 and 100),
    description varchar(8192) null,
    constraint Product_pk
        primary key (product_ID)
);

# Table Image

create table image
(
    image_ID int auto_increment,
    base64 mediumblob null,
    constraint Image_pk
        primary key (image_ID)
);

INSERT INTO image (base64) value ('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JEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJIEkkSSRJJEkkSSRJJEkkSSRJIBJJJEkkSSQBJEkkSSRJJEkkSSRJJEkkSSRJJEkkAAkkSSRJJEkkSSRJJEkkSSRJJEkkSQRJJEgESSRIJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSCRJJEkESSRJJEkkSSRJJEkkSSRJJBJJJEkkSSRJJAkkSSRJJEkkSSRJJEkkSSQBJEkkQABJJEkkEkkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEEkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRIBEkkSSRJJEkkSQRJJEkkSSRJJEkkSSRJJAAAAAAAAAAAAAAAAAAAAkkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRJJEkkSSRBBEkkSQRJJEkkEkkkSSRJJEkkSSRJAEkkSSQAAARABEgkAQQAAQAACSQAIAIJJEEECCACCSRJJEgEAAQBJEEkSCQJIAJJIBAABABJBEEAEgEgSSRJJAEEEEkEAkkgSAASCSABJAgACSRIBAAgCSRJJEgAQQQAJEgEEggEAEgkCAQJABBIJEgEAEkkSSRJJEkkSSRJJEkkSSRIIEkkSSRJJEkkSSRJJEkkSSAJJAkkQSRJIBIJJEgkEEkESSRIJEkkSSRJJEkgEAkgSCQCSCBJBAJJABBBBBJJJEkkSSRJJEkkSSQBBEAgEAkASAQS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');

# Table Image-Product

create table `image-product`
(
    image_ID int not null,
    product_ID int not null
);

# Table Image-Article

create table `image-article`
(
    image_ID   int not null,
    article_ID int not null
);