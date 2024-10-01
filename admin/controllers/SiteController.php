<?php

namespace admin\controllers; // Указываем пространственное имя контроллера, чтобы избежать конфликта с другими классами.

use admin\models\LoginForm; // Подключаем модель формы логина для работы с данными входа.
use Yii; // Подключаем основной компонент Yii для работы с его функциональностью.
use yii\filters\{AccessControl, VerbFilter}; // Импортируем фильтры управления доступом и фильтр методов.
use yii\web\{Controller, ErrorAction, Response}; // Импортируем основные классы для веб-контроллеров и ответов.
use yii\captcha\CaptchaAction; // Импортируем класс для работы с капчей.

/**
 * Site controller
 */
class SiteController extends Controller // Определяем класс SiteController, который наследует базовый контроллер Yii.
{
    /**
     * {@inheritdoc}
     */
    public function behaviors(): array // Метод, возвращающий массив поведения контроллера.
    {
        return [
            'access' => [ // Определяем поведение доступа.
                'class' => AccessControl::class, // Используем класс AccessControl для управления доступом.
                'only' => ['logout', 'signup', 'info'], // Ограничиваем доступ для указанных действий.
                'rules' => [ // Предоставляем массив правил доступа.
                    // Правило, которое закомментировали, разрешает доступ к 'signup' только неавторизованным пользователям.
                    /*
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    */
                    // Правило для 'logout' и 'info', разрешает доступ только авторизованным пользователям.
                    [
                        'actions' => ['logout', 'info'],
                        'allow' => true,
                        'roles' => ['@'], // '@' означает, что доступ открыт только для авторизованных пользователей.
                    ],
                ],
            ],
            'verbs' => [ // Процесс управления методами HTTP.
                'class' => VerbFilter::class, // Используем класс VerbFilter для ограничения методов.
                'actions' => [
                    'logout' => ['post'], // Указываем, что действие logout может быть выполнено только методом POST.
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions(): array // Метод для регистрации действий контроллера.
    {
        return [
            'error' => [ // Действие для обработки ошибок.
                'class' => ErrorAction::class, // Используем класс ErrorAction для отображения ошибок.
            ],
            'captcha' => [ // Действие для работы с капчой.
                'class' => CaptchaAction::class, // Используем класс CaptchaAction для генерации и проверки капчи.
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null, // В тестовом окружении возвращаем фиксированный код. В противном случае null.
            ],
        ];
    }

    /**
     * Displays homepage.
     */
    public function actionIndex(): string // Метод для отображения домашней страницы.
    {
        return $this->render('index'); // Рендерим представление 'index'.
    }

    public function actionIndex1(): string // Метод для отображения страницы логина.
    {
        return $this->render('login'); // Рендерим представление 'login'.
    }

    /**
     * Logs in a user.
     */
    public function actionLogin(): Response|string // Метод для обработки логина пользователя.
    {
        if (!Yii::$app->user->isGuest) { // Проверяем, если пользователь уже авторизован.
            return $this->goHome(); // Если авторизован, перенаправляем на домашнюю страницу.
        }

        $model = new LoginForm(); // Создаем новый экземпляр модели LoginForm.
        // Загружаем данные из POST-запроса и пытаемся выполнить логин.
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            return $this->redirect(Yii::$app->request->referrer); // Перенаправляем на предыдущую страницу, если вход выполнен успешно.
        }

        $model->password = ''; // Очищаем поле пароля в модели для обеспечения безопасности.
        return $this->render('login', [ // В случае ошибки вызываем представление 'login' и передаем модель.
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     */
    public function actionLogout(): Response // Метод для выхода пользователя.
    {
        Yii::$app->user->logout(); // Вызываем метод logout для выхода пользователя.

        return $this->goHome(); // Перенаправляем на домашнюю страницу после выхода.
    }

    public function actionSiteLogin(): string // Метод для отображения страницы информации (например, профиля или настроек).
    {
        return $this->render('info'); // Рендерим представление 'info'.
    }
}
