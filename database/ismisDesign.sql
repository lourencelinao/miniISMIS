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
    subject_id int auto_increment,
    subject_code varchar(8),
    subject_name varchar(32),
    max_students int,
    constraint pk_subjects primary key(subject_id)
);


create table users(
    username int,
    password varchar(32) default "P@ssw0rd",
    user_type enum("Administrator", "Faculty", "Student"),
    status enum("Active", "Inactive") default "Active",
    constraint fk_users foreign key(username) references person(person_id),
    constraint pk_users primary key(username)
);

create table time(
    time_id int auto_increment,
    days varchar(3) not null,
    time varchar(16) not null,
    constraint pk_time primary key(time_id)
);

create table subject_schedule(
    subjectSchedule_id int auto_increment,
    subject_id int,
    faculty_id int,
    time_id int,
    numberOfStudents int ,
    constraint pk_subject_schedule primary key(subjectSchedule_id),
    constraint fk1_subject_schedule foreign key(subject_id) references subjects(subject_id),
    constraint fk2_subject_schedule foreign key(faculty_id) references person(person_id),
    constraint fk3_subject_schedule foreign key(time_id) references time(time_id)
);

create table student_schedule(
    studentSchedule_id int auto_increment,
    student_id int,
    subjectSchedule_id int,
    time_id int,
    constraint pk_student_schedule primary key(studentSchedule_id),
    constraint fk1_student_schedule foreign key(student_id) references person(person_id),
    constraint fk2_student_schedule foreign key(subjectSchedule_id) references subject_schedule(subjectSchedule_id),
    constraint fk3_student_schedule foreign key(time_id) references subject_schedule(time_id)
);

create table auth(
    auth_id int auto_increment,
    person_id int,
    constraint pk_auth primary key(auth_id),
    constraint fk_auth foreign key(person_id) references person(person_id)
);

create table assignedSubjects(
    assignedSubjects_id int auto_increment,
    faculty_id int,
    subject_id int,
    time_id int,
    constraint pk_assignedSubjects primary key(assignedSubjects_id),
    constraint fk1_assignedSubjects foreign key (faculty_id) references person(person_id),
    constraint fk2_assignedSubjects foreign key (subject_id) references subjects(subject_id),
    constraint fk3_assignedSubjects foreign key (time_id) references time(time_id)
);

insert into time(days, time) values("MWF", "7:30-8:30"), ("MWF", "8:30-9:30"),("MWF", "9:30-10:30"),("MWF", "10:30-11:30"),("MWF", "11:30-12:30"),("MWF", "12:30-1:30"),("MWF", "1:30-2:30"),("MWF", "2:30-3:30"),("MWF", "3:30-4:30"),("MWF", "4:30-5:30"),("MWF", "5:30-6:30"),("MWF", "6:30-7:30"),("TTH", "7:30-8:30"), ("TTH", "8:30-9:30"),("TTH", "9:30-10:30"),("TTH", "10:30-11:30"),("TTH", "11:30-12:30"),("TTH", "12:30-1:30"),("TTH", "1:30-2:30"),("TTH", "2:30-3:30"),("TTH", "3:30-4:30"),("TTH", "4:30-5:30"),("TTH", "5:30-6:30"),("TTH", "6:30-7:30");