# Deploying to InfinityFree

The site runs on [InfinityFree](https://infinityfree.com), free shared hosting
(PHP + MySQL + SSL certificate included). Files go over FTP with FileZilla. Check
in the InfinityFree panel that the selected PHP version is 8.3 or later.

## 1. Create the remote database

In the InfinityFree panel, under "MySQL Databases", create a database.
InfinityFree forces a prefixed name (e.g. `if0_XXXXXXX_onemorerep`) and gives you
the MySQL host, user and password to reuse in the `.env`.

## 2. Import the dataset

In InfinityFree's phpMyAdmin, select the database created at step 1, go to the
"Import" tab, pick `onemorerep.sql` and run it. The file imports straight into
the selected database — it contains no `CREATE DATABASE`.

## 3. Transfer the files over FTP

Get the FTP credentials from the InfinityFree panel (FTP host, user, password),
then connect with FileZilla. Transfer the whole project into the server's
`htdocs/` folder.

The `vendor/` folder (Composer dependencies) has to be transferred too: the free
InfinityFree plan cannot run `composer install`. The `tests/`, `.github/` and
`.git/` folders are not needed in production.

## 4. Create the production `.env`

The `.env` is not versioned (it sits in `.gitignore`), so it is not in the
repository. Create it directly on the server, or send it over FileZilla, with the
MySQL credentials InfinityFree gave you:

```
DB_HOST=sqlXXX.infinityfree.com
DB_NAME=if0_XXXXXXX_onemorerep
DB_CHARSET=utf8mb4
DB_USER=if0_XXXXXXX
DB_PASSWORD=your_password
```

## 5. Test in production

Open the site URL (the InfinityFree subdomain) and walk the whole path: home page
and map, exercise list and filters, sign-up and sign-in, creating a program, TDEE
calculator.

Then replace the administrator account password with a private one that never
appears in the repository.
