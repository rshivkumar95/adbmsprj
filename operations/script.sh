#!/bin/bash
hadoop fs -put company.txt naukri/input/company.txt
hadoop fs -put experience.txt naukri/input/experience.txt
hadoop fs -put jobtitle.txt naukri/input/jobtitle.txt
hadoop fs -put location.txt naukri/input/location.txt
hadoop fs -put salary.txt naukri/input/salary.txt
hadoop fs -put skills.txt naukri/input/skills.txt
hadoop fs -rmr naukri/company
hadoop jar naukridhanda.jar naukri/input/company.txt naukri/company
hadoop fs -rmr naukri/experience
hadoop jar naukridhanda.jar naukri/input/experience.txt naukri/experience
hadoop fs -rmr naukri/jobtitle
hadoop jar naukridhanda.jar naukri/input/jobtitle.txt naukri/jobtitle
hadoop fs -rmr naukri/location
hadoop jar naukridhanda.jar naukri/input/location.txt naukri/location
hadoop fs -rmr naukri/salary
hadoop jar naukridhanda.jar naukri/input/salary.txt naukri/salary
hadoop fs -rmr naukri/skills
hadoop jar naukridhanda.jar naukri/input/skills.txt naukri/skills
rm company/*
hadoop fs -get naukri/company/p* company/
rm experience/*
hadoop fs -get naukri/experience/p* experience/
rm jobtitle/*
hadoop fs -get naukri/jobtitle/p* jobtitle/
rm location/*
hadoop fs -get naukri/location/p* location/
rm salary/*
hadoop fs -get naukri/salary/p* salary/
rm skills/*
hadoop fs -get naukri/skills/p* skills/
