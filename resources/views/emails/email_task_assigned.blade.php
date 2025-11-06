<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Назначение на задачу</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #6f42c1;
        }
        .header h1 {
            color: #6f42c1;
            margin: 0;
            font-size: 24px;
        }
        .content {
            color: #333;
        }
        .project-status {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
            border-left: 4px solid #6f42c1;
        }
        .project-status h3 {
            margin-top: 0;
            color: #6f42c1;
        }
        .status-row {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 15px 0;
            font-size: 16px;
        }
        .status-current {
            background: #6f42c1;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            font-weight: bold;
        }
        .project-info {
            background: #e9ecef;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .info-row {
            margin: 8px 0;
        }
        .label {
            font-weight: bold;
            color: #555;
        }
        .impact-notice {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .impact-notice h4 {
            margin-top: 0;
            color: #856404;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            text-align: center;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Назначение на задачу</h1>
    </div>

    <div class="content">
        <p>Здравствуйте, <strong>{{ $task->user->name }}</strong>!</p>

        <p>Вы были назначены ответственным за выполнение новой задачи в системе TaskFlow.</p>

        <div class="project-status">
            <h3>Статус назначения:</h3>
            <div class="status-row">
                <span class="status-current">{{ $task->status->name }}</span>
            </div>
        </div>

        @if($task)
            <div class="project-info">
                <div class="info-row">
                    <span class="label">Название:</span> {{ $task->name }}
                </div>

                <div class="info-row">
                    <span class="label">Описание:</span> {{ $task->description ?? 'Не указано' }}
                </div>

                <div class="info-row">
                    <span class="label">Проект:</span> {{ $task->project->name }}
                </div>

                <div class="info-row">
                    <span class="label">Срок выполнения:</span> {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('d.m.Y H:i') : 'Не указан' }}
                </div>

                <div class="info-row">
                    <span class="label">Дата назначения:</span> {{ $task->created_at->format('d.m.Y H:i') }}
                </div>
            </div>
        @else
            <div class="project-info">
                <p>Информация о задаче временно недоступна.</p>
            </div>
        @endif

        <div class="impact-notice">
            <h4>Следующие шаги:</h4>
            <p>Пожалуйста, ознакомьтесь с задачей и приступите к её выполнению. При возникновении вопросов или необходимости уточнения деталей обращайтесь к руководителю проекта или к тому, кто назначил задачу.</p>
        </div>

        <p>Следите за сроками выполнения и обновляйте статус задачи по мере продвижения работы.</p>

        <p>Успехов в работе!</p>
    </div>

    <div class="footer">
        <p>Это автоматическое уведомление из системы TaskFlow<br>
            Пожалуйста, не отвечайте на это письмо</p>
    </div>
</div>
</body>
</html>
