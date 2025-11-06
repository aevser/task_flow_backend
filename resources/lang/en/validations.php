<?php

return [
    'auth' => [
        'email' => [
            'required' => 'Email field is required.',
            'email' => 'Please enter a valid email address.'
        ],
        'password' => [
            'required' => 'Password field is required.'
        ]
    ],

    'task' => [
        'index' => [
            'assignee_id' => [
                'integer' => 'Assignee ID must be a number.',
                'exists' => 'The selected assignee does not exist.',
            ],
            'status_id' => [
                'required' => 'Task status is required.',
                'integer' => 'Status ID must be a number.',
                'exists' => 'The specified status does not exist.'
            ],
            'due_date' => [
                'date_format' => 'Date must be in DD.MM.YYYY format.'
            ],
            'perPage' => [
                'integer' => 'The number of items per page must be a number.',
                'min' => 'Minimum number of items per page: 1.',
                'max' => 'Maximum number of items per page: 100.',
            ],
            'page' => [
                'integer' => 'The page number must be a number.',
                'min' => 'The page number must be greater than 0.'
            ]
        ],
        'create' => [
            'assignee_id' => [
                'integer' => 'Assignee ID must be a number.',
                'exists' => 'The selected assignee does not exist.',
            ],
            'name' => [
                'required' => 'Task name is a required field.',
                'string' => 'Task name must be a string.',
                'max' => 'Task name cannot exceed :max characters.',
            ],
            'description' => [
                'string' => 'Description must be a string.',
                'max' => 'Description cannot exceed :max characters.'
            ],
            'due_date' => [
                'date_format' => 'Date must be in DD.MM.YYYY format.'
            ],
            'attachments' => [
                'array' => 'Attachments must be an array.',
                'max' => 'You can upload a maximum of 5 files.',
                'file' => 'Attachment must be a file.',
                'max_size' => 'File size must not exceed 10 MB.',
                'mimes' => 'Allowed file formats: pdf, doc, docx, xls, xlsx, jpg, jpeg, png, zip.'
            ]
        ],
        'update' => [
            'assignee_id' => [
                'integer' => 'Assignee ID must be a number.',
                'exists' => 'The selected assignee does not exist.',
            ],
            'status_id' => [
                'required' => 'Task status is required.',
                'integer' => 'Status ID must be a number.',
                'exists' => 'The specified status does not exist.'
            ],
            'name' => [
                'required' => 'Task name is a required field.',
                'string' => 'Task name must be a string.',
                'max' => 'Task name cannot exceed :max characters.',
            ],
            'description' => [
                'string' => 'Description must be a string.',
                'max' => 'Description cannot exceed :max characters.'
            ],
            'due_date' => [
                'date_format' => 'Date must be in DD.MM.YYYY format.'
            ]
        ]
    ]
];
