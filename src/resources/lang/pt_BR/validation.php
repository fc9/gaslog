<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'O campo :attribute deve ser aceito.',
    'active_url' => 'O campo :attribute deve conter uma URL válida.',
    'after' => 'O campo :attribute deve conter uma data posterior a :date.',
    'after_or_equal' => 'O campo :attribute deve conter uma data superior ou igual a :date.',
    'alpha' => 'O campo :attribute deve conter apenas letras.',
    'alpha_dash' => 'O campo :attribute deve conter apenas letras, números e traços.',
    'alpha_num' => 'O campo :attribute deve conter apenas letras e números .',
    'array' => 'O campo :attribute deve conter um array.',
    'base64_image' => 'O campo :attribute deve conter uma imagem.',
    'base64_doc' => 'O campo :attribute deve conter um documento (pdf/doc).',
    'base64_mixed' => 'O campo :attribute deve conter uma imagem ou documento válido',
    'before' => 'Deve conter uma data igual ou inferior a atual.',
    'before_or_equal' => 'O campo :attribute deve conter uma data inferior ou igual a :date.',
    'between' => [
        'numeric' => 'O campo :attribute deve conter um número entre :min e :max.',
        'file' => 'O campo :attribute deve conter um arquivo de :min a :max kilobytes.',
        'string' => 'O campo :attribute deve conter entre :min a :max caracteres.',
        'array' => 'O campo :attribute deve conter de :min a :max itens.',
    ],
    'boarded' => 'Ativo não possui dispositivo embarcado',
    'boolean' => 'O campo :attribute deve conter o valor sim ou não.',
    'cep' => 'O :attribute informado não é válido.',
    'confirmed' => 'A confirmação para o campo :attribute não coincide.',
    'cpf_format' => 'O :attribute informado não tem o formato válido.',
    'cpf' => 'O CPF informado não é válido.',
    'cnpj' => 'O :attribute informado não contém um CNPJ válido.',
    'color_hex' => 'O :attribute não possui uma cor hexadecimal.',
    'date' => 'O campo :attribute não contém uma data válida.',
    'date_format' => 'A data informada para o campo :attribute não respeita o formato :format.',
    'different' => 'Os campos :attribute e :other devem conter valores diferentes.',
    'digits' => 'O campo :attribute deve conter :digits dígitos.',
    'digits_between' => 'O campo :attribute deve conter entre :min a :max dígitos.',
    'dimensions' => 'O valor informado para o campo :attribute não é uma dimensão de imagem válida.',
    'distinct' => 'O campo :attribute contém um valor duplicado.',
    'email' => 'O campo não contém um endereço de email válido.',
    'exists' => 'O campo :attribute é inválido.',
    'file' => 'O campo :attribute deve conter um arquivo.',
    'filled' => 'O campo :attribute é obrigatório.',
    'image' => 'O campo :attribute deve conter uma imagem.',
    'in' => 'O campo :attribute não contém um valor válido.',
    'in_array' => 'O campo :attribute não existe em :other.',
    'integer' => 'O campo :attribute deve conter um número inteiro.',
    'ip' => 'O campo :attribute deve conter um IP válido.',
    'json' => 'O campo :attribute deve conter uma string JSON válida.',
    'max' => [
        'numeric' => 'O campo não pode conter um valor superior a :max.',
        'file' => 'O campo :attribute não pode conter um arquivo com mais de :max kilobytes.',
        'string' => 'O campo :attribute não pode conter mais de :max caracteres.',
        'array' => 'O campo :attribute deve conter no máximo :max itens.',
    ],
    'mimes' => 'O campo :attribute deve conter um arquivo do tipo: :values.',
    'mimetypes' => 'O campo :attribute deve conter um arquivo do tipo: :values.',
    'min' => [
        'numeric' => 'O campo :attribute deve conter um número superior ou igual a :min.',
        'file' => 'O campo :attribute deve conter um arquivo com no mínimo :min kilobytes.',
        'string' => 'O campo :attribute deve conter no mínimo :min caracteres.',
        'array' => 'O campo :attribute deve conter no mínimo :min itens.',
    ],
    'money' => 'O valor do campo :attribute não está no formato de dinheiro (000,00)',
    'not_in' => 'O campo :attribute contém um valor inválido.',
    'numeric' => 'O campo :attribute deve conter um valor numérico.',
    'phone' => 'O campo :attribute não contém um número de telefone válido.',
    'present' => 'O campo :attribute deve estar presente.',
    'regex' => 'O formato do valor informado no campo :attribute é inválido.',
    'required' => 'O campo não pode ficar em branco.',
    'required_if' => 'O campo não pode ficar em branco.',
    'required_unless' => 'O campo :attribute é obrigatório a menos que :other esteja presente em :values.',
    'required_with' => 'O campo :attribute é obrigatório quando :values está presente.',
    'required_with_all' => 'O campo :attribute é obrigatório quando um dos :values está presente.',
    'required_without' => 'O campo :attribute é obrigatório quando :values não está presente.',
    'required_without_all' => 'O campo :attribute é obrigatório quando nenhum dos :values está presente.',
    'same' => 'Os campos :attribute e :other devem conter valores iguais.',
    'size' => [
        'numeric' => 'O campo :attribute deve conter o número :size.',
        'file' => 'O campo :attribute deve conter um arquivo com o tamanho de :size kilobytes.',
        'string' => 'O campo :attribute deve conter :size caracteres.',
        'array' => 'O campo :attribute deve conter :size itens.',
    ],
    'string' => 'O campo :attribute deve ser uma string.',
    'timezone' => 'O campo :attribute deve conter um fuso horário válido.',
    'unique' => 'O :attribute informado já está em uso.',
    'uploaded' => 'Falha no upload do arquivo :attribute.',
    'url' => 'O formato da URL informada para o campo :attribute é inválido.',
    'youtube_url' => "O link do vídeo deve pertencer ao Youtube.",
    'facebook_url' => "O link deve pertencer ao Facebook.",
    'instagram_url' => "O link deve pertencer ao Instagram.",
    'required_checkbox' => "O campo é obrigatório",

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'city_id' => 'cidade',
        'title' => 'título',
        'address_city_habitants_count' => 'quantidade de habitantes na sua cidade',
        'student_contributors_count' => 'quantidade de estudantes envolvidos no projeto',
        'educator_contributors_count' => 'quantidade de educadores envolvidos no projeto',
        'other_contributors' => 'outros contribuidores',
        'applied_at' => 'aplicação do projeto',
        'affected_school_members' => 'quantidade de pessoas atingidas pelo projeto na escola',
        'affected_outside_members' => 'quantidade de pessoas atingidas pelo projeto fora da escola',
        'summary' => 'resumo',
        'target_problem' => 'questão/problema escolhido',
        'target_problem_reason' => 'razão da escolha',
        'target_problem_development' => 'como os estudantes chegaram à proposta de ação',
        'group_actions' => 'ações realizadas pelo grupo',
        'group_mobility' => 'como o grupo se mobilizou',
        'general_impact' => 'como o projeto impactou o grupo os integrantes do grupo',
        'individual_impact' => 'seu papel como na elaboração do projeto',
        'additional_info' => 'informações adicionais',
        'facebook_link' => 'Link do facebook',
        'full_name' => 'nome completo',
        'phone' => 'telefone',
        'mobile_phone' => 'celular',
        'current_course_year' => 'ano que o estudante está cursando',
        'address_zipcode' => 'cep',
        'address_address' => 'endereço',
        'address_number' => 'número',
        'address_additional' => 'complemento',
        'traffic_source_id' => 'origem'
    ],

];
