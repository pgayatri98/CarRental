create database CarRentals;

use CarRentals;

create table Car (
    c_id integer primary key,
    c_name varchar(20) not null,
    c_image varchar(100),
    c_fuel varchar(10) not null,
    c_type varchar(10) not null,
    c_location varchar(30) not null,
    c_PPH integer not null
    -- PPH stands for price per hour
);

create table User (
    u_id integer primary key,
    u_password varchar(20) not null,
    u_name varchar(50) not null unique,
    u_email varchar(30) not null,
    u_phone varchar(12) not null,
    u_license char(16) not null,
    u_rating integer
);

create table Booking (
    c_id integer not null,
    u_id integer not null,
    date_of_booking timestamp not null,
    start_time timestamp not null,
    return_time timestamp not null
);

alter table Booking
add constraint c_id_booking_fk foreign key(c_id) references Car(c_id),
add constraint u_id_booking_fk foreign key(u_id) references User(u_id);

delimiter //

create trigger check_availability
before insert
on Booking
for each row
begin
    declare counter int;

    select count(c_id) into counter from Booking where c_id = NEW.c_id;
    if counter > 0
    then
        signal sqlstate '50000';
    end if;

    select count(c_id) into counter from Booking where c_id = NEW.c_id and start_time < NEW.return_time and return_time > NEW.start_time;
    if counter > 0
    then
        signal sqlstate '45000';
    end if;
end//

delimiter ;