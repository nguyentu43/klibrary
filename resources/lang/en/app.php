<?php

return [
    'book' => [
        'singular' => 'Book',
        'plural' => 'Books',
        'lastest' => 'Lastest books',
        'send' => 'Send to kindle',
        'sent' => 'Mail sent',
        'size' => 'Book Size',
        'upload' => 'Upload Your Book',
        'edit' => 'Edit Book',
        'title' => 'Title',
        'authors' => 'Authors',
        'comments' => 'Comments',
        'identifier' => 'Identifier',
        'tags' => 'Tags',
        'publisher' => 'Publisher',
        'language' => 'Language',
        'date' => 'Pubdate',
        'cover' => 'Cover',
        'update' => 'Update',
        'show_trash' => 'Show Trashed File Only',
        'hide_trash' => 'Hide Trashed Files',
        'empty' => 'Empty',
        'delete' => 'Delete Book',
        'convert' => 'Convert Book',
        'delete_format' => 'Delete Format',
        'download' => 'Download',
        'format' => 'Format',
        'messages' => [
            'add' => 'Book ":book" Added',
            'update' => 'Book ":book" Updated',
            'trash' => 'Book ":book" Move To Trash',
            'delete' => 'Book ":book" Deleted',
            'restore' => 'Book ":book" Restored',
            'convert' => 'Convert Format Is Starting...'
        ],
        'errors' => [
            'convert' => 'You Must Select Format Convert :format'
        ]
    ],
    'collection' => [
        'singular' => 'Collection',
        'plural' => 'Collections',
        'create' => 'Create New Collection',
        'title' => 'Collection: :collection',
        'delete' => 'Delete Collection',
        'list_book' => 'List Book In Collection',
        'edit' => 'Edit Collection',
        'name' => 'Name',
        'books' => 'Books',
        'update' => 'Update',
        'empty_book' => 'Click Edit To Add The Book',
        'messages' => [
            'add' => 'Collection ":collection" Added',
            'update' => 'Collection ":collection" Updated',
            'delete' => 'Collection ":collection" Deleted'
        ]
    ],
    'device' => [
        'singular' => 'Device',
        'plural' => 'Devices',
        'create' => 'Create New Device',
        'name' => 'Name',
        'type' => 'Device type',
        'email' => 'Kindle Email',
        'default' => 'Set Default',
        'this_default' => 'Default',
        'edit' => 'Edit Device',
        'delete' => 'Delete Device',
        'update' => 'Update',
        'messages' => [
            'add' => 'Device ":device" Added',
            'update' => 'Device ":device" Updated',
            'delete' => 'Device ":device" Deleted'
        ]
    ],
    'user' => [
        'singular' => 'User',
        'plural' => 'Users',
        'name' => 'Name',
        'email' => 'Email',
        'email_to' =>'To',
        'email_from' => 'From',
        'action' => 'Action',
        'admin' => 'Admin',
        'password' => 'Password',
        'old_password' => 'Old Password',
        'confirm_password' => 'Confirm Password',
        'register' => 'Register',
        'edit' => 'Edit User',
        'update' => 'Update',
        'login' => 'Login',
        'remember_me' => 'Remember Me',
        'forgot_your_password' => 'Forgot Your Password?',
        'delete' => 'Delete User',
        'create' => 'Create User',
        'messages' => [
            'add' => 'User ":user" Added',
            'update' => 'User ":user" Updated',
            'delete' => 'User ":user" Deleted'
        ],
        'profile' => 'Edit Account',
        'email_approved_list' => 'List Email Approved',
        'link_approved_kindle' => 'Click here to add email approved kindle',
        'new_password' => 'New Password',
        'same_old_password' => 'Old Password not match'
    ],
    'job' => [
        'singular' => 'Job',
        'plural' => 'Jobs',
        'content' => 'Content',
        'status' => 'Status',
        'started_at' => 'Started At',
        'finished_at' => 'Finished At',
        'send_to_kindle' => "Send :format Format Book ':title' To Kindle :email",
        'convert' => "Convert :format Format Book ':title'",
        'delete' => 'Delete',
        'messages' => [
            'delete' => 'Job :job deleted'
        ]
    ],
    'empty' => 'Click + to add item'
];