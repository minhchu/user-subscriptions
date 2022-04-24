# Instruction

1. Install this project as any other Laravel project
2. Run migration with seeder `php artisan migrate --seed`
3. Setup [mailtrap](https://mailtrap.io/) to view test emails

# APIs

1. Subscribe an user to a website:

```bash
# I'm using httpie
http POST inisev.loc/api/subscriptions user_id:=1 website_id:=1
```

Response:
```json
{
    "created_at": "2022-04-24T17:21:07.000000Z",
    "id": 1,
    "updated_at": "2022-04-24T17:21:07.000000Z",
    "user_id": 1,
    "website_id": 1
}
```

2. Create a new post for a website

```bash
# I'm using httpie
http POST inisev.loc/api/subscriptions title='New post' description='Hello world' website_id:=1
```

Response:
```json
{
    "created_at": "2022-04-24T17:25:03.000000Z",
    "description": "Hello world",
    "id": 14,
    "title": "New post",
    "updated_at": "2022-04-24T17:25:03.000000Z",
    "website_id": 1
}

```
