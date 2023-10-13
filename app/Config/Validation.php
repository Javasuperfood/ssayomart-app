<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    //--------------------------------------------------------------------
    // Rules For Registration
    //--------------------------------------------------------------------
    public $registration = [
        'username' => [
            'label' => 'Auth.username',
            'rules' => [
                'required',
                'max_length[30]',
                'min_length[3]',
                'regex_match[/\A[a-zA-Z0-9\.]+\z/]',
                'is_unique[users.username]',
            ],
            'errors' => [
                'required' => 'Username tidak boleh kosong.',
                'max_length' => 'Username terlalu panjang.',
                'min_length' => 'Username terlalu pendek.',
                'is_unique' => 'Username yang dimasukkan sudah terdaftar.',
                'regex_match' => 'Username hanya boleh huruf, angka dan tanpa sepasi.'
            ]
        ],
        'email' => [
            'label' => 'Auth.email',
            'rules' => [
                'required',
                'max_length[254]',
                'valid_email',
                'is_unique[auth_identities.secret]',
            ],
            'errors' => [
                'required' => 'Email tidak boleh kosong.',
                'max_length' => 'Email terlalu panjang.',
                'valid_email' => 'Email tidak valid.',
                'is_unique' => 'Email yang dimasukkan sudah terdaftar.'
            ]
        ],
        'password' => [
            'label' => 'Auth.password',
            'rules' => 'required|max_byte[72]|strong_password[]',
            'errors' => [
                'max_byte' => 'Password terlalu panjang.',
                'strong_password' => 'Password terlalu lemah.',
                'required' => 'Password tidak boleh kosong.'
            ]
        ],
        'password_confirm' => [
            'label' => 'Auth.passwordConfirm',
            'rules' => 'required|matches[password]',
            'errors' => [
                'required' => 'Password tidak boleh kosong.',
                'matches' => 'Password yang dimasukkan tidak cocok.'
            ],
        ]
    ];

    //--------------------------------------------------------------------
    // Rules For Login
    //--------------------------------------------------------------------
    public $login = [
        // 'username' => [
        //     'label' => 'Auth.username',
        //     'rules' => [
        //         'required',
        //         'max_length[30]',
        //         'min_length[3]',
        //         'regex_match[/\A[a-zA-Z0-9\.]+\z/]',
        //     ],
        // ],
        'email' => [
            'label' => 'Auth.email',
            'rules' => [
                'required',
                'max_length[254]',
                'valid_email'
            ],
            'errors' => [
                'required' => 'Email tidak boleh kosong.',
                'max_length' => 'Email terlalu panjang.',
                'valid_email' => 'Email tidak valid.'
            ]
        ],
        'password' => [
            'label' => 'Auth.password',
            'rules' => [
                'required',
                'max_byte[72]',
            ],
            'errors' => [
                'required' => 'Password tidak boleh kosong.',
                'max_byte' => 'Auth.errorPasswordTooLongBytes',
            ]
        ],
    ];
}
