create database mini_ismis;

use mini_ismis;

create table person(
    person_id int,
    fname varchar(32),
    mi char(1),
    lname varchar(32),
    email varchar(64),
    contact long,
    birthdate date,
    address varchar(128),
    person_type enum("Faculty", "Student"),
    status enum("Active", "Inactive") default "Active",
    constraint pk_student primary key(person_id)
);


create table subjects(
    subject_id int,
    faculty_id int,
    subject_name varchar(32),
    max_students int,
    constraint pk_subjects primary key(subject_id),
    constraint fk_subjets foreign key(faculty_id) references person(person_id)
);


create table users(
    username int,
    password varchar(32) default "P@ssw0rd",
    user_type enum("Administrator", "Faculty", "Student"),
    status enum("Active", "Inactive") default "Active",
    constraint fk_users foreign key(username) references person(person_id),
    constraint pk_users primary key(username)
);

create table subject_schedule(
    subjectSchedule_id int auto_increment,
    subject_id int,
    faculty_id int,
    time varchar(5),
    constraint pk_subject_schedule primary key(subjectSchedule_id),
    constraint fk1_subject_schedule foreign key(subject_id) references subjects(subject_id),
    constraint fk2_subject_schedule foreign key(faculty_id) references person(person_id)
);

create table student_schedule(
    studentSchedule_id int auto_increment,
    student_id int,
    subjectSchedule_id int,    
    constraint pk_student_schedule primary key(studentSchedule_id),
    constraint fk1_student_schedule foreign key(student_id) references person(person_id),
    constraint fk2_student_schedule foreign key(subjectSchedule_id) references subject_schedule(subjectSchedule_id)
);

create table auth(
    auth_id int auto_increment,
    person_id int,
    constraint pk_auth primary key(auth_id),
    constraint fk_auth foreign key(person_id) references person(person_id)
);