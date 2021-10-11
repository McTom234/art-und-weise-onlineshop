create database artundweise;
use artundweise;
# Table Users

create table `user`
(
    user_ID     varchar(100) not null,
    forename    varchar(255) not null,
    surname     varchar(255) not null,
    email       varchar(255) not null,
    password    varchar(512) not null,
    location_ID varchar(100) not null,
    constraint User_pk
        primary key (user_ID)
);

create unique index User_Email_uindex
    on `user` (email);

# Table Location

create table `location`
(
    location_ID   varchar(100) not null,
    user_ID       varchar(100) not null,
    street        varchar(512) not null,
    street_number varchar(128) not null,
    postcode      int          not null,
    city          varchar(512) not null,
    constraint User_pk
        primary key (location_ID),
    constraint User_fk
        foreign key (user_ID) references user (user_ID)
);

# Table Order

create table `order`
(
    order_ID   varchar(100) not null,
    product_ID varchar(100) not null,
    price      int          not null,
    discount   int          null,
    quantity   int          not null,
    constraint Order_pk
        primary key (order_ID)
);

# Table Checkout - "Bill/Rechnung"

create table `checkout`
(
    checkout_ID varchar(100) not null,
    user_ID     varchar(100) not null,
    tip         int          null,
    member_ID   int          null,
    constraint Checkout_pk
        primary key (checkout_ID)
);

# Table Checkout-Order

create table `checkout-order`
(
    checkout_ID varchar(100) not null,
    order_ID    varchar(100) not null
);

create unique index Checkout_Order_ID_uindex
    on `checkout-order` (order_ID);

# Table Member

create table member
(
    member_ID varchar(100) not null,
    user_ID   varchar(100) not null,
    rights    int          null,
    constraint Member_pk
        primary key (member_ID),
    constraint Member_fk
        foreign key (user_ID) references user (user_ID)
);

create unique index Member_UserID_uindex
    on member (user_ID);

# Table Article

create table article
(
    article_ID  varchar(100)                        not null,
    title       varchar(512)                        null,
    content     varchar(8192)                       not null,
    publish     timestamp default CURRENT_TIMESTAMP not null,
    likes       int       default 0                 not null,
    num_of_read int       default 0                 not null,
    constraint Article_pk
        primary key (article_ID)
);


# Table Member-Article

create table `member-article`
(
    member_ID  varchar(100) not null,
    article_ID varchar(100) not null
);

# Table Product

create table product
(
    product_ID  varchar(100)  not null,
    name        varchar(1024) not null,
    price       int           not null,
    discount    int           not null default 0 check ( discount between 0 and 100),
    description varchar(8192) null,
    constraint Product_pk
        primary key (product_ID)
);

# Table Category

create table category
(
    category_ID varchar(100)  not null,
    name        varchar(1024) not null,
    primary key (category_ID)
);

# Table Category - Product

create table `category-product`
(
    category_ID varchar(100) not null,
    product_ID  varchar(100) not null
);


# Table Image

create table image
(
    image_ID varchar(100) not null,
    base64   mediumblob   null,
    constraint Image_pk
        primary key (image_ID)
);

# Table Image-Product

create table `image-product`
(
    image_ID   varchar(100) not null,
    product_ID varchar(100) not null
);

# Table Image-Article

create table `image-article`
(
    image_ID   varchar(100) not null,
    article_ID varchar(100) not null
);

create trigger product_insert_discountCheck
    before insert
    on product
    for each row
begin
    if NEW.discount > 100 then
        set NEW.discount = 100;
    end if;
    if NEW.discount < 0 then
        set NEW.discount = 0;
    end if;
end;
create trigger product_update_discountCheck
    before update
    on product
    for each row
begin
    if NEW.discount > 100 then
        set NEW.discount = 100;
    end if;
    if NEW.discount < 0 then
        set NEW.discount = 0;
    end if;
end;

create trigger order_insert_discountCheck
    before insert
    on `order`
    for each row
begin
    if NEW.discount > 100 then
        set NEW.discount = 100;
    end if;
    if NEW.discount < 0 then
        set NEW.discount = 0;
    end if;
end;
create trigger order_update_discountCheck
    before update
    on `order`
    for each row
begin
    if NEW.discount > 100 then
        set NEW.discount = 100;
    end if;
    if NEW.discount < 0 then
        set NEW.discount = 0;
    end if;
end;