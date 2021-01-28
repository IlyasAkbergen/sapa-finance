<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="yandex-verification" content="86c9f5bf65e2fb5c"/>
    <title>Sapa</title>
    <script src="https://kit.fontawesome.com/c9e46db961.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('landing/styles/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('landing/styles/style.css')}}">
    <link rel="stylesheet" href="{{asset('landing/slick-1.8.1/slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('landing/slick-1.8.1/slick/slick-theme.css')}}">
    @livewireStyles
    <style>
        .result {
            display: none;
        }
        .question {
            display: none;
        }
        .active {
            display: block;
        }
        .question label{
            margin-bottom: 5px;
        }
        #auth button {
            color: #0a884d;
            background: none;
            border: 1px solid transparent;
            padding: 5px 15px;
            border-radius: 25px;
            transition: .5s;

        }

        #auth ul li:last-child button {
            border: 1px solid #0a884d;
        }

        #auth button:hover {
            color: #fff;
            background: #0a884d;
            transition: .5s;
        }

        .modal {
            background-color: rgba(1, 15, 52, 0.7);
        }

        .modal-dialog-auth {
            max-width: 25%;
            margin: 50px auto;
        }
        .modal-dialog-test {
            max-width: 50%;
            margin: 50px auto;
        }
        .modal-dialog-consultant{
            max-width: 70%;
        }
        .modal-dialog-consultant .modal-content .modal-body .d-flex div:last-child{
            margin-left: 50px;
        }
        .btn-close {
            background: url(../images/icons/close.svg);
            background-size: contain;
            opacity: 1;
            position: absolute;
            right: -90%;
            top: 0%;
        }

        .btn-close:hover {
            cursor: pointer;
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 40px 20px 20px;
            border-radius: 10px;
        }

        .modal-content input[type=text], .modal-content input[type=password] {
            width: 100%;
            padding: 7px 15px;
            border-radius: 24px;
            border: 1px solid #C2C3CF;
            margin-bottom: 20px;
        }

        .modal-content h3 {
            text-align: center;
            color: #190134;
            font-weight: bold;
            font-size: 20px;
        }

        .modal-content .modal-btn {
            width: 100%;
            background: #0a884d;
            border: 1px solid #0a884d;
            border-radius: 24px;
            color: #fff;
            padding: 5px;
            transition: .5s;
            cursor: pointer;
            font-weight: bold;
        }

        .modal-content .modal-btn:hover {
            background: #fff;
            color: #0a884d;
            transition: .5s;
        }

        .modal-footer button {
            width: 100%;
            border: 1px solid #373777;
            border-radius: 24px;
            color: #373777;
            display: block;
            padding: 6px;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            transition: .5s;
            font-weight: bold;
        }

        .modal-footer button:hover {
            background: #373777;
            color: #fff;
            transition: .5s;
        }

        .modal-flex {
            display: flex;
            justify-content: space-between;
            padding: 20px 0;
            color: #190134;
        }

        .modal-flex a {
            color: #190134;
            text-decoration: none;
        }

        @media (max-width: 1199px) {
            #auth ul li {
                padding-left: 15px;
            }

            #auth button {
                color: #fff;
                background: #0a884d;
                margin-bottom: 5px;
            }

        }

        @media (max-width: 991px) {
            .modal-dialog-auth {
                max-width: 60%;
                margin: 1.75rem auto;
            }

        }
        @media (max-width: 767px){
            .modal-dialog-test {
                max-width: 90%;
                margin: 50px auto;
            }
        }
        @media (max-width: 576px) {
            .modal-dialog-auth {
                max-width: 80%;
                margin: 1.75rem auto;
            }
            .modal-dialog-consultant{
                max-width: 90%;
            }
        }

        html {
            overflow-x: hidden;
        }
    </style>
</head>
    <body>
    <div class="body-wrapper">
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
        <header>
            <div class="inner">
                <img src="{{asset('images/icons/logo.png')}}" alt="Logo"/>
                <a href="#" id="logo">
                    SAPA
                </a>
                <div id="navs">
                    <nav id="menu">
                        <ul>
                            <li><a href="#about">О компании</a></li>
                            <li><a href="#academy__inner__1">SAPA Academy</a></li>
                            <li><a href="#academy__inner__2">SAPA Market</a></li>
                            <li><a href="#">Стать партнером</a></li>
                            <li><a href="#">Стать агентом</a></li>
                            <li><a href="#footer">Контакты</a></li>
                        </ul>
                    </nav>
                    <nav id="auth">
                        <ul>
                            <li>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#authModal">
                                    Войти
                                </button>
                            </li>
                            <li>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#regModal">
                                    Зарегистрироваться
                                </button>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="menu-toggle"><i class="fas fa-bars"></i></div>
            </div>
        </header>

        @yield('content')

        <footer id="footer">
            <div class="footer__inner">
                <div>
                    <img src="{{asset('images/icons/footer-icon.png')}}" alt="">
                </div>
                <div>
                    <p class="footer__title">Sapa</p>
                    <ul class="menu-vertical">
                        <li><a href="#">Главная</a></li>
                        <li><a href="#">SAPA Academy</a></li>
                        <li><a href="#">SAPA Market</a></li>
                        <li><a href="#">Стать партнером</a></li>
                        <li><a href="#">Стать агентом</a></li>
                    </ul>
                </div>
                <div>
                    <p class="footer__title">Документы</p>
                    <ul class="menu-vertical">
                        <li><a href="#">Политика конфиденциальности</a></li>
                        <li><a href="#">Публичная оферта</a></li>
                        <li><a href="#">Отказ от ответственности</a></li>
                        <li><a href="#">Презентация о компании</a></li>
                    </ul>
                </div>
                <div class="footer__socials">
                    <p class="footer__title">Социальные сети</p>
                    <ul class="menu-horizontal">
                        <li><a href="#"><img src="{{asset('images/icons/footer-social-youtube.png')}}" alt=""></a></li>
                        <li><a href="#"><img src="{{asset('images/icons/footer-social-fb.png')}}" alt=""></a></li>
                        <li><a href="#"><img src="{{asset('images/icons/footer-social-vk.png')}}" alt=""></a></li>
                        <li><a href="#"><img src="{{asset('images/icons/footer-social-instagram.png')}}" alt=""></a></li>
                        <div class="clearfix"></div>
                    </ul>
                    <p class="footer__title">Контакты</p>
                    <div class="footer__phone">
                        <img src="{{asset('images/icons/footer-phone.png')}}" alt="">
                        <p>+7 707 747 0427</p>
                    </div>
                    <div class="footer__mail">
                        <img src="{{asset('images/icons/footer-mail.png')}}" alt="">
                        <p>info@sapazhol.kz</p>
                    </div>
                </div>
            </div>
        </footer>

        <div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-auth">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-content">
                    <h3>Вход в систему</h3>
                    <div class="modal-body">
                        <livewire:login-form/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-toggle="modal"
                                data-bs-target="#regModal">
                            Зарегистрироваться
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="consultantModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-consultant">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-content">
                    
                    <div class="modal-body">
                        <div class="d-flex">
                            <div>
                                <img src="http://127.0.0.1:8000/images/slides/consultants-consultants-slider-img4.png" alt="">
                            </div>
                            <div>
                                <h3>Брасилова Акжунис</h3>
                                <p>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde, dignissimos magnam harum! Molestias, ut. Ipsam accusantium ut tenetur veritatis, mollitia eaque aperiam, labore, aliquid architecto enim dolor amet. Obcaecati sequi saepe ut maxime non officiis incidunt consequatur iure molestias inventore?
                                </p>
                                <p>
                                    Lorem, ipsum dolor sit amet consectetur adipisicing, elit. Voluptates, modi perspiciatis corporis reprehenderit libero, vero debitis ipsum, eius beatae architecto accusantium sequi veniam deleniti voluptatem nemo rem, nisi ipsa distinctio!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="quizModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-test">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-content">
                    <h3>Тест</h3>
                    <div class="modal-body">
                        <div class="quiz">
                            <div class="question active" id="question-1">
                                <h3>1.  Изучали ли Вы когда-нибудь финансовую грамотность ранее?</h3>
                                <input type="radio" name="answer-1" id="ch1" value="5">
                                <label for="ch1">Да, я постоянно этим занимаюсь</label><br>
                                <input type="radio" name="answer-1" id="ch2" value="3">
                                <label for="ch2">Да, я время от времени изучаю новые инструменты</label><br>
                                <input type="radio" name="answer-1" id="ch3" value="2">
                                <label for="ch3">Да, изучала ранее, но не хватает времени</label><br>
                                <input type="radio" name="answer-1" id="ch4" value="1">
                                <label for="ch4">Нет, считаю, что в этом нет необходимости</label><br>
                                <input type="radio" name="answer-1" id="ch5" value="2">
                                <label for="ch5">Только сейчас начинаю</label><br>
                                <button class="next">Следующий</button>
                            </div>
                            <div class="question" id="question-2">
                                <h3>2.  Ставите ли Вы себе финансовые цели?</h3>
                                <input type="radio" name="answer-2" id="ch6" value="5">
                                <label for="ch6">Да, периодически делаю</label><br>
                                <input type="radio" name="answer-2" id="ch7" value="3">
                                <label for="ch7">Да, писал(а) пару раз</label><br>
                                <input type="radio" name="answer-2" id="ch8" value="1">
                                <label for="ch8">Нет, не считаю это нужным</label><br>
                                <input type="radio" name="answer-2" id="ch9" value="2">
                                <label for="ch9">Все мои цели у меня в голове</label><br>
                                <input type="radio" name="answer-2" id="ch10" value="1">
                                <label for="ch10">Я не умею ставить цели</label><br>
                                <input type="radio" name="answer-2" id="ch11" value="1">
                                <label for="ch11">Другое</label><br>
                                <button class="next">Следующий</button>
                            </div>
                            <div class="question" id="question-3">
                                <h3>3.  Знаете ли Вы что такое личный (семейный) бюджет?</h3>
                                <input type="radio" name="answer-3" id="ch12" value="3">
                                <label for="ch12">Да, я знаю, но не веду</label><br>
                                <input type="radio" name="answer-3" id="ch13" value="5">
                                <label for="ch13">Да, я знаю и периодически веду</label><br>
                                <input type="radio" name="answer-3" id="ch14" value="5">
                                <label for="ch14">Да, я знаю и постоянно веду</label><br>
                                <input type="radio" name="answer-3" id="ch15" value="1">
                                <label for="ch15">Нет, ничего об этом не знаю</label><br>
                                <input type="radio" name="answer-3" id="ch16" value="2">
                                <label for="ch16">Нет, я считаю, что это не нужно</label><br>
                                <input type="radio" name="answer-3" id="ch17" value="1">
                                <label for="ch17">Другое</label><br>
                                <button class="next">Следующий</button>
                            </div>
                            <div class="question" id="question-4">
                                <h3>4.  Знаете ли Вы, что такое активы?</h3>
                                <input type="radio" name="answer-4" id="ch18" value="3">
                                <label for="ch18">Да, слышал(а) об этом</label><br>
                                <input type="radio" name="answer-4" id="ch19" value="4">
                                <label for="ch19">Да, работаю над этим</label><br>
                                <input type="radio" name="answer-4" id="ch20" value="5">
                                <label for="ch20">Да, у меня есть активы</label><br>
                                <input type="radio" name="answer-4" id="ch21" value="1">
                                <label for="ch21">Нет, не знаю что такое активы</label><br>
                                <input type="radio" name="answer-4" id="ch22" value="1">
                                <label for="ch22">Нет, и не считаю это необходимым</label><br>
                                <input type="radio" name="answer-4" id="ch23" value="1">
                                <label for="ch23">Другое</label><br>
                                <button class="next">Следующий</button>
                            </div>
                            <div class="question" id="question-5">
                                <h3>5.  Выберете свой результат Доходы минус расходы?</h3>
                                <input type="radio" name="answer-5" id="ch24" value="0">
                                <label for="ch24">Доходы – Расходы = -</label><br>
                                <input type="radio" name="answer-5" id="ch25" value="1">
                                <label for="ch25">Доходы – Расходы = 0</label><br>
                                <input type="radio" name="answer-5" id="ch26" value="3">
                                <label for="ch26">Доходы – Расходы = +</label><br>
                                <button class="next">Следующий</button>
                            </div>
                            <div class="question" id="question-6">
                                <h3>6.  Есть ли у вас кредиты?</h3>
                                <input type="radio" name="answer-6" id="ch27" value="1">
                                <label for="ch27">Да, я постоянно беру кредиты</label><br>
                                <input type="radio" name="answer-6" id="ch28" value="2">
                                <label for="ch28">Да, у меня большой кредит</label><br>
                                <input type="radio" name="answer-6" id="ch29" value="4">
                                <label for="ch29">Да, но их немного</label><br>
                                <input type="radio" name="answer-6" id="ch30" value="3">
                                <label for="ch30">Нет, никогда не брал(а)</label><br>
                                <input type="radio" name="answer-6" id="ch31" value="5">
                                <label for="ch31">Нет, но ранее были</label><br>
                                <input type="radio" name="answer-6" id="ch32" value="4">
                                <label for="ch32">Нет, я отрицательно отношусь к кредитам</label><br>
                                <button class="next">Следующий</button>
                            </div>
                            <div class="question" id="question-7">
                                <h3>7.  Есть ли у Вас опыт инвестирования?</h3>
                                <input type="radio" name="answer-7" id="ch33" value="5">
                                <label for="ch33">Да, положительный</label><br>
                                <input type="radio" name="answer-7" id="ch34" value="2">
                                <label for="ch34">Да, отрицательный</label><br>
                                <input type="radio" name="answer-7" id="ch35" value="3">
                                <label for="ch35">Нет, но я хочу попробовать</label><br>
                                <input type="radio" name="answer-7" id="ch36" value="2">
                                <label for="ch36">Нет, я считаю это рискованно</label><br>
                                <input type="radio" name="answer-7" id="ch37" value="1">
                                <label for="ch37">Нет, эта тема меня не интересует</label><br>
                                <button class="next">Следующий</button>
                            </div>
                            <div class="question" id="question-8">
                                <h3>8.  Знаете ли Вы, что такое Личный Финансовый План?</h3>
                                <input type="radio" name="answer-8" id="ch38" value="5">
                                <label for="ch38">Да, у меня есть ЛФП</label><br>
                                <input type="radio" name="answer-8" id="ch39" value="3">
                                <label for="ch39">Да, но я не имею ЛФП</label><br>
                                <input type="radio" name="answer-8" id="ch40" value="3">
                                <label for="ch40">Нет, но я бы хотел(а) создать ЛФП </label><br>
                                <input type="radio" name="answer-8" id="ch41" value="1">
                                <label for="ch41">Нет, я ничего не знаю об этом</label><br>
                                <input type="radio" name="answer-8" id="ch42" value="3">
                                <label for="ch42">Я сейчас в процессе обучения</label><br>
                                <button class="next">Следующий</button>
                            </div>
                            <div class="question" id="question-9">
                                <h3>9.  Есть ли у Вас "подушка безопасности"?</h3>
                                <input type="radio" name="answer-9" id="ch43" value="5">
                                <label for="ch43">Да, это должно быть у каждого человека (семьи)</label><br>
                                <input type="radio" name="answer-9" id="ch44" value="4">
                                <label for="ch44">Да, но сумма там еще не достаточная</label><br>
                                <input type="radio" name="answer-9" id="ch45" value="3">
                                <label for="ch45">Нет, но хочу создать "подушку безопасности"</label><br>
                                <input type="radio" name="answer-9" id="ch46" value="1">
                                <label for="ch46">Нет, мне не нужна "подушка безопасности"</label><br>
                                <input type="radio" name="answer-9" id="ch47" value="1">
                                <label for="ch47">Что такое "подушка безопасности"?</label><br>
                                <button class="next">Следующий</button>
                            </div>
                            <div class="question" id="question-10">
                                <h3>10. Сколько у Вас источников доходов?</h3>
                                <input type="radio" name="answer-10" id="ch48" value="3">
                                <label for="ch48">1-2 источника</label><br>
                                <input type="radio" name="answer-10" id="ch49" value="5">
                                <label for="ch49">3-5 источников</label><br>
                                <input type="radio" name="answer-10" id="ch50" value="5">
                                <label for="ch50">Более 5 источников</label><br>
                                <input type="radio" name="answer-10" id="ch51" value="1">
                                <label for="ch51">На текущий момент нет дохода</label><br>
                                <button class="next">Следующий</button>
                            </div>
                            <div class="question" id="question-11">
                                <h3>11. Есть ли у Вас пассивные источники доходов?</h3>
                                <input type="radio" name="answer-11" id="ch52" value="5">
                                <label for="ch52">Да, у меня их несколько</label><br>
                                <input type="radio" name="answer-11" id="ch53" value="4">
                                <label for="ch53">Да, только один  источник пассивного дохода</label><br>
                                <input type="radio" name="answer-11" id="ch54" value="2">
                                <label for="ch54">Нет, у меня только активные источники доходов</label><br>
                                <input type="radio" name="answer-11" id="ch55" value="1">
                                <label for="ch55">Что такое пассивный источник доходов?</label><br>
                                <input type="radio" name="answer-11" id="ch56" value="2">
                                <label for="ch56">Другое</label><br>
                                <button class="next">Следующий</button>
                            </div>
                            <div class="result">
                                <h3 class="result__header"></h3>
                                <div class="result__text">asd</div>
                                <a href="/" class="close">
                                    Закрыть
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="regModal" tabindex="-1"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-auth">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-content">
                    <h3>Зарегистрироваться</h3>
                    <div class="modal-body">
                        @livewire('register-form', ['referrer_id' => $referrer_id ?? null])
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal" aria-label="Close"
                                data-bs-toggle="modal" data-bs-target="#authModal">
                            Войти
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="passModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-auth">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-content">
                    <h3>Восстановление пароля</h3>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <x-jet-label for="email" value="{{ __('Email') }}"/>
                            <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email"
                                         required autofocus/>
                            <div class="text-left">
                                <p>
                                    Когда вы введете вашу почту, вам будет отправлено сообщение со ссылкой на форму
                                    обновления пароля.
                                </p>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal" aria-label="Close">
                            Отправить
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="article-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg scrollable">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-content">
                    <img class="img-fluid" src="" alt="img" id="article-img">
                    <h3 id="article-title"></h3>
                    <div class="modal-body" id="article-body">

                    </div>
                </div>
            </div>
        </div>

        @livewireScripts
        @stack('script')
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="{{asset('landing/scripts/jquery-3.5.1-min.js')}}"></script>
        <script src="{{asset('landing/scripts/bootstrap.min.js')}}"></script>
        <script src="{{asset('landing/slick-1.8.1/slick/slick.min.js')}}"></script>

        <script>
            $total = 0
            $index = 1
            $questionCount = 11
            $('.next').click(function(e) {
                $value = $('#question-' + $index + ' input[name="answer-' + $index + '"]:checked').val()
                if ($value == undefined) {
                    alert('Выберите одну из ответов!')
                    return false
                }
                console.log(1)
                $total += parseInt($value)

                $('#question-' + $index).removeClass('active')
                $index++
                if ($index > $questionCount) {
                    $('.result__header').html('Вы набрали ' + $total + ' баллов')
                    if ($total > 0 && $total < 20)
                        $('.result__text').html(`У вас слабая финансовая устойчивость. Вам необходимо менять свои финансовые привычки, для того чтобы изменить ситуацию и начать повышать свой уровень финансовой устойчивости. Отсутствие базовых навыков финансовой грамотности в будущем может отрицательно сказаться на вашем финансовом положении. 
    Мы рекомендуем начать изучение финансовой грамотности с прохождения краткого курса «Финансовый экспресс» или базового курса «Мастерская личных финансов». Для развития ментальных привычек финансово грамотного человека также рекомендуем игру «Денежный поток 101» и «Денежный поток олигарха». 
    `)
                    else if ($total >= 20 && $total < 50)
                        $('.result__text').html(`У вас средний уровень финансовой устойчивости. Скорее всего у вас неплохой доход, есть финансовый потенциал, который нужно правильно использовать. Возможно не все имеющиеся знания вы готовы использовать на практике. Нужно задуматься о повышении своей финансовой грамотности и внедрении в жизнь правильных финансовых привычек, чтобы вывести свое финансовое положение на более высокий уровень – все возможности для этого у вас есть. 
    Скорее всего Вы уже готовы попробовать серьезные инвестиционные продукты фондового рынка, рекомендуем пройти курс «Инвестиции с умом», чтобы начать самостоятельную торговлю на фондовом рынке. 
    `)
                    else
                        $('.result__text').html(`Вы – финансово-грамотный человек, у вас высокий уровень финансовой устойчивости, но еще есть к чему стремиться. Поработайте над созданием дополнительных источников пассивного дохода, созданием финансовых активов, изучайте новые возможности сохранения и приумножения капитала. Не забывайте, что финансовый мир не стоит на месте, каждый день появляются новые инструменты и новые возможности. `)
                    $('.result').addClass('active')
                }

                $('#question-' + $index).addClass('active')
            })

            $('.close').click(function() {
                $total = 0
                $index = 1
                $('#question-' + $index).addClass('active')
                $('.result').removeClass('active')
                $('input[type="radio"]').prop('checked', false)
                $('.quiz').css('display', 'none')
            })
        </script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('.menu-toggle').click(function () {
                    $('#navs').toggleClass('active');
                    $(this).toggleClass('menu-toggle-active');
                    $('body').toggleClass('disable-scroll');
                })

                $('.articles__slider').slick({
                    infinite: true,
                    autoplay: true,
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    arrows: true,
                    prevArrow: '<button class="slide-arrow prev-arrow"></button>',
                    nextArrow: '<button class="slide-arrow next-arrow"></button>',
                    responsive: [
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 2
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 1
                            }
                        }
                    ]
                });

                $('.main-slider').slick({
                    infinite: true,
                    autoplay: true,
                    pauseOnHover: false,
                    dots: true,
                    arrows: false,
                });

                $('.community__blog-slider__for').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    fade: true,
                    asNavFor: '.community__blog-slider__nav'
                });

                $('.community__blog-slider__nav').slick({
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    asNavFor: '.community__blog-slider__for',
                    focusOnSelect: true,
                    autoplay: true,
                    arrows: true,
                    prevArrow: '<button class="slide-arrow community__blog-slider__prev"></button>',
                    nextArrow: '<button class="slide-arrow community__blog-slider__next"></button>'
                });

                $('.founder__slider').slick({
                    autoplay: true,
                    fade: true,
                    arrows: true,
                    prevArrow: '<button class="slide-arrow founder__slider__prev"></button>',
                    nextArrow: '<button class="slide-arrow founder__slider__next"></button>'
                });

                $('.academy__slider1').slick({
                    infinite: false,
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    dots: true,
                    responsive: [
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 2
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                dots: false
                            }
                        }
                    ]
                });

                $('.academy__slider2').slick({
                    infinite: false,
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    dots: true,
                    responsive: [
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 2
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                dots: false
                            }
                        }
                    ]
                });

                $('.consultants__main__slider').slick({
                    autoplay: true,
                    fade: true,
                    arrows: true,
                    prevArrow: '<button class="slide-arrow consultants__main__slider__prev"></button>',
                    nextArrow: '<button class="slide-arrow consultants__main__slider__next"></button>'
                });

                $('.consultants__consultants__slider').slick({
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    arrows: true,
                    dots: true,
                    infinite: false,
                    responsive: [
                        {
                            breakpoint: 1200,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                dots: false
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                arrows: false
                            }
                        }
                    ]
                });
            })

            function openArticleModal(title, content, imgPath) {
                $('#article-img').attr('src', imgPath);
                $('#article-title').html(title);
                $('#article-body').html(content);
                $('#article-modal').modal('show');
            }
        </script>
    </div>
</body>
</html>
