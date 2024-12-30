Prosty system do zarządzania projektami 

Celem zadania jest stworzenie prostego systemu do zarządzania projektami w oparciu o Laravel i Filament (https://filamentphp.com). System powinien umożliwiać: 

    Tworzenie, edycję i usuwanie projektów 

    Tworzenie, edycję i usuwanie zadań w ramach projektów 

    Przypisywanie zadań do użytkowników 

    Określanie statusu zadań (np. "do zrobienia", "w trakcie", "zakończone") 

Projekty powinny mieć następujące pola: 

    Nazwa 

    Opis 

    Data rozpoczęcia 

    Data zakończenia (opcjonalne) 

Zadania powinny mieć następujące pola: 

    Nazwa 

    Opis 

    Data rozpoczęcia 

    Data zakończenia (opcjonalne) 

    Status 

    Przypisany użytkownik (opcjonalne) 

System powinien umożliwiać filtrowanie i sortowanie projektów oraz zadań według nazwy, daty rozpoczęcia i zakończenia oraz statusu. 

System powinien używać bazy danych (dowolnej – SQLite, MySQL, PgSQL) do przechowywania informacji o projektach i zadaniach oraz mieć przygotowane migracje dla bazy danych.  
