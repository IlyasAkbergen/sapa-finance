@extends('layouts.guest')
@section('content')
    <div class="main-slider">
        <div>
            <div class="main-slider__inner-block">
                <h1>Обучение, инвестирование, соправождение</h1>
                <p>Повышение финансовой грамотности является целью каждого преуспевающего человека</p>
                <a href="#">Подробнее</a>
            </div>
            <img src="{{asset('images/slides/image.png')}}" alt="">
        </div>
        <div>
            <div class="main-slider__inner-block">
                <h1>Обучение, инвестирование, соправождение</h1>
                <p>Повышение финансовой грамотности является целью каждого преуспевающего человека</p>
                <a href="#">Подробнее</a>
            </div>
            <img src="{{asset('images/slides/image.png')}}" alt="">
        </div>
        <div>
            <div class="main-slider__inner-block">
                <h1>Обучение, инвестирование, соправождение</h1>
                <p>Повышение финансовой грамотности является целью каждого преуспевающего человека</p>
                <a href="#">Подробнее</a>
            </div>
            <img src="{{asset('images/slides/image.png')}}" alt="">
        </div>
    </div>

    <div id="test">
        <div class="inner">
            <div>
                <p>Пройди тест и определи свою финансовою стратегию!</p>
                <button type="button" data-bs-toggle="modal" data-bs-target="#quizModal">Пройти тест</button>
            </div>
            <div>
                <p>Пройди тест и определи свою финансовою стратегию!</p>
                <button>Пройти диагностику</button>
            </div>
        </div>
    </div>

    <div class="community">
        <div class="community__inner">
            <div class="community__blog">
                <div class="community__blog__title">
                    <h1>Повышение финансовой грамотности является целью каждого преуспевающего человека</h1>
                </div>
                <div class="community__blog__main">
                    <h1>Сообщество</h1>
                    <img src="/images/community-blog-img.png" alt="">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        the industry's standard dummy text ever.</p>
                </div>
            </div>
            <div class="community__blog-slider">
                <div class="community__blog-slider__for">
                    <div>
                        <p class="slide-ttext">
                            Lorem ipsum dolor sit, amet consectetur adipisicing, elit. Aliquam odit assumenda asperiores iure, nisi nobis, quasi, itaque quisquam eveniet fuga ullam distinctio sed exercitationem esse atque, repellat voluptate aperiam non.
                        </p>
                        <img src="/images/slides/community-slider-img1.png" alt="">
                        <a href="#" class="slide-button">
                            Подробнее
                        </a>
                    </div>
                    <div>
                        <p class="slide-ttext">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iste qui accusamus enim, cupiditate. Iusto, sit, ipsa illum animi quasi at odio perspiciatis, voluptatibus praesentium alias quia tempore dignissimos rem placeat vero natus deserunt, harum laudantium. Perferendis placeat quaerat aperiam, modi.
                        </p>
                        <img src="/images/slides/community-slider-img2.png" alt="">
                        <a href="#" class="slide-button">
                            Подробнее
                        </a>
                    </div>
                    <div>
                        <p class="slide-ttext">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente, quos?
                        </p>
                        <img src="/images/slides/community-slider-img3.png" alt="">
                        <a href="#" class="slide-button">
                            Подробнее
                        </a>
                    </div>
                    <div>
                        <p class="slide-ttext">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias deserunt maxime delectus inventore dolores voluptate doloribus, eveniet obcaecati magni neque dolorum commodi quos at rem fugiat quod ad, quasi earum quis ea quaerat minima ex repudiandae aliquam nostrum. Voluptas illo error rerum consequuntur similique debitis quisquam reiciendis vero aliquam corporis, eveniet adipisci inventore dolores, iusto, in alias perferendis blanditiis? Ratione?
                        </p>
                        <img src="/images/slides/community-slider-img2.png" alt="">
                        <a href="#" class="slide-button">
                            Подробнее
                        </a>
                    </div>
                </div>
                <div class="community__blog-slider__nav">
                    <div>
                        <img src="/images/slides/community-slider-img1-mini.png" alt="">
                    </div>
                    <div>
                        <img src="/images/slides/community-slider-img2-mini.png" alt="">
                    </div>
                    <div>
                        <img src="/images/slides/community-slider-img3-mini.png" alt="">
                    </div>
                    <div>
                        <img src="/images/slides/community-slider-img2-mini.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="about">
        <div class="wrapper">
            <div class="inner">
                <h1>О компании</h1>
                <p style="margin-bottom: 1rem;">
                    <b>Согласно Постановления Правительства Республики Казахстан от 30 мая 2020 года №338 «Об утверждении Концепции повышения финансовой грамотности на 2020 – 2024 годы».<br>
                    Проект является инновационным и конкурентноспособным не только на территории г. Алматы, но и по Республике в целом.</b><br><br>
                    Повышение финансовой грамотности населения является приоритетным направлением, но не развитым. В г. Алматы нет подобного рода услуг в одном месте. Имеющиеся финансовые консультанты лишь агенты отдельных компаний, представители инвестиционных компаний, либо финансовых пирамид. Финансовых пирамид на сегодняшний день очень много, на них есть спрос, соответственно постоянно возникает предложение. Население  хочет заработать быстро, надеется успеть забрать свои деньги, рискует, но чаще всего не успевает. <br>
                    <i style="font-size: 16px;">Вся информация по финансовым продуктам будет идти по принципу одного окна. В центре всегда «стоит» клиент со своими потребностями и целями. </i><br><br>
                    Мы хотим стать узнаваемым брендом Казахстана путем внедрения стандартизации, привлечения лучших как местных, так и зарубежных, специалистов в своей области! <br>
                    <b>Миссия компании – оказание максимального содействия в повышении финансовых знаний населения, как основного элемента системы защиты прав потребителей финансовых услуг, непрерывного доступа населения к финансовым услугам, обеспечения финансовой стабильности и общественного благосостояния</b> путем предоставления:
                </p>
                <ul style="list-style: decimal; text-align: left;">
                    <li>
                        персонифицированных консультационных услуг широкого спектра (обучение эффективному управлению личными финансами);
                    </li>
                    <li>
                        консалтинг в области современных методик и технологий персонального (частного ) финансового планирования и обслуживания;
                    </li>
                    <li>
                        исследовательские проекты;
                    </li>
                    <li>
                        сотрудничество с компаниями с возможностью предоставления займов и инвестиций в долю бизнеса для поддержания развития казахстанского бизнеса;
                    </li>
                    <li>
                        подготовка специалистов по нескольким уникальным направлениям: «Независимый Финансовый Советник», «Управление Личными Финансами», «Личное Финансовое Планирование».
                    </li>
                </ul>
                <p style="margin-bottom: 1rem;">
                    Центр уделяет большое внимание развитию цивилизованного рынка услуг Независимых Финансовых Советников и формированию стандартов качественного обслуживания в сфере управления личными финансами.
                    В основе программ подготовки лежат Европейские методики управления личными финансами, используемые более 30 лет Независимыми финансовыми советниками в странах Европы и Северной Америки и адаптированные к казахстанским условиям.
                    <br><br>
                    Центр является лидером рынка обучения методикам управления личными финансами. Прежде всего, работа компании представляется в роли своеобразного моста, причем как по финансовому, так и по образовательному направлению. Практически данный проект позволит центру продавать свой практический опыт, знания и партнерства, что для любого человека (семьи), для любого предпринимателя (компании) является наиболее практичным, полезным и значимым.
                </p>
            </div>
        </div>
    </div>

    <div class="founder">
        <div class="founder__inner">
            <div class="founder__main">
                <h1>Об основателе</h1>
                <p>
                    Айгуль Дильдабековна, родилась 19 ноября  1962 г. в г. Ташкент, в Республике Узбекистане. В 1980 г. окончила специализированный класс средней школы № 3 имени Н. Крупской в г. Джамбуле. В 1985 г. Окончила с отличием Джамбульский гидромелиоративно-строительный институт, факультет «Гидромелиорация», специальность: «Инженер-гидротехник». В 1995 гг. окончила Шымкентский педагогический институт, факультет: «Русский язык и литература в национальной школе», специальность: «Учитель русского языка».
                </p>
                <ul style="list-style: none;">
                    <li>Трудовую деятельность начала в 1988 году в колхозе им. Ленина, Ленинского районы ЮКО – администратор;</li>
                    <li>1990 – 1995 гг. - Школа им. Алтынсарина, с. Каратас, Ленинского района ЮКО – преподаватель русского языка;</li>
                    <li>1995 – 2003 гг. – Частный предприниматель;</li>
                    <li>2003 – 2008 гг. -  Независимый консультант, агент по страхованию жизни</li>
                    <li>2008 – 2009 гг. - Агент в БТА в отделе «Депозиты», менеджер в НПФ «БТА Казахстан»;</li>
                    <li>2009 – 2011 гг. - Алматы, АО «L-Capital» - директор учебного центра;</li>
                    <li>2011 – 2012 гг. принимала активное участие в продвижении государственной программы по повышению инвестиционной культуры и финансовой грамотности населения. Для реализации этой Программы в 2010 году было заключено соглашение о сотрудничестве 04-19/66-20 между акционерным обществом «Региональный Финансовый Центр Города Алматы» и Акционерным обществом «L-CAPITAL»;</li>
                    <li>2012 г. принимала активное участие в консультативной работе по открытию брокерских счетов для реализации программы «народное IPO» в Республике Казахстан в сотрудничестве с брокерской компанией «Асыл-Инвест».</li>
                </ul>
                <p>
                    Для повышения  квалификации  прошла следующие курсы:
                </p>
                <ul style="list-style: none;">
                    <li>- 2002 – 2003 гг. – Финансовые семинары за рубежом;</li>
                    <li>- 2004 г. – Тренинг «Психология продаж», Австрия г. Грац;</li>
                    <li>- 2006 г. – Повышение квалификации по специальности «Накопительное страхование жизни», Австрия, г. Грац;</li>
                    <li>- 2008 г. – «Как заработать деньги без стартового капитала», Алматы, С. Азимов;</li>
                    <li>- 2009 г. – «Мой гениальный ребенок», Алматы, С. М. Давлатов;</li>
                    <li>- 2011 г. – обучение в Академии РФЦА, г. Алматы;</li>
                    <li>- 2012 г. – «Новые инвестиционные решения», Дубаи, ОАЭ;</li>
                    <li>- 2012 г. – «Законы судьбы», Алматы, О. Гадецкий;</li>
                    <li>- Март 2013 г. – «Лучшие техники продаж», Алматы, А.Винс;</li>
                    <li>- Май 2013 г. «Техника продажи», Анталья, В. Красноруцкий;</li>
                    <li>- Октябрь 2013 г. – «Ораторское искусство 2.0», мастер-класс Р.Гандапаса;</li>
                    <li>- Ноябрь 2013 г. – Сертификационный курс «НЛП-Практик» (I- модуль);</li>
                    <li>- Декабрь 2013 г. – Сертификационный курс «НЛП-Практик» (II- модуль);</li>
                    <li>- Февраль 2014 г. – Сертификационный курс «НЛП-Практик» (III- модуль);</li>
                    <li>- 2014 г. Дистанционное обучение «Практическая Психология», Европейская школа корреспондентского обучения;</li>
                </ul>
                <p>
                    В 2016 году является руководителем ТОО « Школа финансовой грамотности Айгуль Абдраимовой». <br>
                    В ноябре 2017 года  начали реализацию с Национальной библиотекой РК совместного социально-образовательный проекта «Центр финансовой грамотности «BEREKE».
                </p>
                <div class="founder__slider">
                    <div>
                        <img src="{{asset('images/slides/founder-slider-img1.png')}}" alt="">
                    </div>
                    <div>
                        <img src="{{asset('images/slides/founder-slider-img2.jpeg')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="academy">
        <div class="academy__inner">
            <div class="academy__inner__1" id="academy__inner__1">
                <h1>SAPA Academy</h1>
                <div class="academy__slider1">
                    @foreach($courses as $course)
                    <div>
                        <img src="{{asset('images/icons/academy-slider-img1.png')}}" alt="">
                        <h1>{{ $course->title }}</h1>
                        <p>
                            {{ $course->short_description }}
                        </p>
                        <a href="{{ route('guest_course', $course->id) }}">Подробнее о курсе</a>
                    </div>
                    @endforeach
{{--                    <div>--}}
{{--                        <img src="{{asset('images/icons/academy-slider-img1.png')}}" alt="">--}}
{{--                        <h1>Курсы, тренинги</h1>--}}
{{--                        <p>--}}
{{--                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has--}}
{{--                            been the industry's standard dummy text ever.--}}
{{--                        </p>--}}
{{--                        <a href="#">Подробнее о курсе</a>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <img src="{{asset('images/icons/academy-slider-img3.png')}}" alt="">--}}
{{--                        <h1>Составление ЛФП</h1>--}}
{{--                        <p>--}}
{{--                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has--}}
{{--                            been the industry's standard dummy text ever.--}}
{{--                        </p>--}}
{{--                        <a href="#">Подробнее о курсе</a>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <img src="{{asset('images/icons/academy-slider-img3.png')}}" alt="">--}}
{{--                        <h1>Курсы, тренинги</h1>--}}
{{--                        <p>--}}
{{--                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has--}}
{{--                            been the industry's standard dummy text ever.--}}
{{--                        </p>--}}
{{--                        <a href="#">Подробнее о курсе</a>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <img src="{{asset('images/icons/academy-slider-img3.png')}}" alt="">--}}
{{--                        <h1>Составление ЛФП</h1>--}}
{{--                        <p>--}}
{{--                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has--}}
{{--                            been the industry's standard dummy text ever.--}}
{{--                        </p>--}}
{{--                        <a href="#">Подробнее о курсе</a>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <img src="{{asset('images/icons/academy-slider-img1.png')}}" alt="">--}}
{{--                        <h1>Финансовая диагностика</h1>--}}
{{--                        <p>--}}
{{--                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has--}}
{{--                            been the industry's standard dummy text ever.--}}
{{--                        </p>--}}
{{--                        <a href="#">Подробнее о курсе</a>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <img src="{{asset('images/icons/academy-slider-img1.png')}}" alt="">--}}
{{--                        <h1>Финансовая диагностика</h1>--}}
{{--                        <p>--}}
{{--                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has--}}
{{--                            been the industry's standard dummy text ever.--}}
{{--                        </p>--}}
{{--                        <a href="#">Подробнее о курсе</a>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <img src="{{asset('images/icons/academy-slider-img2.png')}}" alt="">--}}
{{--                        <h1>Курсы, тренинги</h1>--}}
{{--                        <p>--}}
{{--                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has--}}
{{--                            been the industry's standard dummy text ever.--}}
{{--                        </p>--}}
{{--                        <a href="#">Подробнее о курсе</a>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <img src="{{asset('images/icons/academy-slider-img3.png')}}" alt="">--}}
{{--                        <h1>Составление ЛФП</h1>--}}
{{--                        <p>--}}
{{--                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has--}}
{{--                            been the industry's standard dummy text ever.--}}
{{--                        </p>--}}
{{--                        <a href="#">Подробнее о курсе</a>--}}
{{--                    </div>--}}
                </div>
            </div>
            <div class="academy__inner__2" id="academy__inner__2">
                <h1>SAPA Market</h1>
                <div class="academy__slider2">
                    @foreach($courses as $course)
                    <div>
                        <img src="{{asset('images/icons/academy-slider-img1.png')}}" alt="">
                        <h1>{{ $course->title }}</h1>
                        <p>
                            {{ $course->short_description }}
                        </p>
                        <a href="{{ route('guest_course', $course->id) }}">Подробнее о курсе</a>
                    </div>
                    @endforeach
{{--                    <div>--}}
{{--                        <img src="{{asset('images/icons/academy-slider-img2.png')}}" alt="">--}}
{{--                        <h1>Курсы, тренинги</h1>--}}
{{--                        <p>--}}
{{--                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has--}}
{{--                            been the industry's standard dummy text ever.--}}
{{--                        </p>--}}
{{--                        <a href="#">Подробнее о курсе</a>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <img src="{{asset('images/icons/academy-slider-img3.png')}}" alt="">--}}
{{--                        <h1>Составление ЛФП</h1>--}}
{{--                        <p>--}}
{{--                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has--}}
{{--                            been the industry's standard dummy text ever.--}}
{{--                        </p>--}}
{{--                        <a href="#">Подробнее о курсе</a>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <img src="{{asset('images/icons/academy-slider-img2.png')}}" alt="">--}}
{{--                        <h1>Курсы, тренинги</h1>--}}
{{--                        <p>--}}
{{--                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has--}}
{{--                            been the industry's standard dummy text ever.--}}
{{--                        </p>--}}
{{--                        <a href="#">Подробнее о курсе</a>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <img src="{{asset('images/icons/academy-slider-img3.png')}}" alt="">--}}
{{--                        <h1>Составление ЛФП</h1>--}}
{{--                        <p>--}}
{{--                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has--}}
{{--                            been the industry's standard dummy text ever.--}}
{{--                        </p>--}}
{{--                        <a href="#">Подробнее о курсе</a>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <img src="{{asset('images/icons/academy-slider-img1.png')}}" alt="">--}}
{{--                        <h1>Финансовая диагностика</h1>--}}
{{--                        <p>--}}
{{--                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has--}}
{{--                            been the industry's standard dummy text ever.--}}
{{--                        </p>--}}
{{--                        <a href="#">Подробнее о курсе</a>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <img src="{{asset('images/icons/academy-slider-img1.png')}}" alt="">--}}
{{--                        <h1>Финансовая диагностика</h1>--}}
{{--                        <p>--}}
{{--                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has--}}
{{--                            been the industry's standard dummy text ever.--}}
{{--                        </p>--}}
{{--                        <a href="#">Подробнее о курсе</a>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <img src="{{asset('images/icons/academy-slider-img2.png')}}" alt="">--}}
{{--                        <h1>Курсы, тренинги</h1>--}}
{{--                        <p>--}}
{{--                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has--}}
{{--                            been the industry's standard dummy text ever.--}}
{{--                        </p>--}}
{{--                        <a href="#">Подробнее о курсе</a>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <img src="{{asset('images/icons/academy-slider-img3.png')}}" alt="">--}}
{{--                        <h1>Составление ЛФП</h1>--}}
{{--                        <p>--}}
{{--                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has--}}
{{--                            been the industry's standard dummy text ever.--}}
{{--                        </p>--}}
{{--                        <a href="#">Подробнее о курсе</a>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>

    <div id="materials">
        <div class="inner">
            <div class="materials-text">
                <img src="{{asset('images/icons/Paper.png')}}" alt="paper">
                <p>Полезные материалы</p>
            </div>
            <div class="files">
                <a href="#"><img src="{{asset('images/icons/Downlaod.png')}}" alt="">Шаблон бюджета</a>
                <a href="#"><img src="{{asset('images/icons/Downlaod.png')}}" alt="">Гайд</a>
                <a href="#"><img src="{{asset('images/icons/Downlaod.png')}}" alt="">Чек-лист</a>
            </div>
        </div>
    </div>

    <div class="consultants">
        <div class="consultants__inner">
            <div class="consultants__main">
                <p>
                    <b>Центр повышения квалификации финансовых консультантов</b> - это обучение и развитие навыков и
                    компитенции профессиональных финансовых советников
                </p>
                <div class="consultants__main__slider">
                    <div>
                        <img src="{{asset('images/slides/consultants-consultants-slider-img1.png')}}" alt="">
                    </div>
                    <div>
                        <img src="{{asset('images/slides/consultants-consultants-slider-img2.png')}}" alt="">
                    </div>
                </div>
            </div>
            <div class="consultants__consultants">
                <h1>Выбери финансового консультанта</h1>
                <div class="consultants__consultants__slider">
                    @foreach($consultants as $consultant)
                        <div>
                            <a style="border: none; background: none;" type="button"
                               href="{{ route('guest_consultant', $consultant->id) }}">
                                <p>{{ $consultant->name }}</p>
                                <img src="{{
                                    $consultant->profile_photo_path
                                    ?: asset('images/slides/consultants-consultants-slider-img4.png')
                                }}">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="articles">
        <div class="articles__wrapper">
            <h1>Статьи</h1>
            <div class="articles__slider">
                @foreach($articles as $article)

                    @php

                        $imgPath = !empty($article->image_path)
                                        ? $article->image_path
                                        : asset('images/slides/articles-slider-img1.png');
                        $title = $article->title;
                        $content = $article->content;
                    @endphp
                    <div>
                        <div class="articles__slider__slide__inner">
                            <img src="{{$imgPath}}"
                            >
                            <p>
                                {{ substr($title, 0, 65) . (strlen($title) > 65 ? '...' : '') }}
                            </p>
                            <p>
                                {{ substr($content, 0, 65) . (strlen($content) > 65 ? '...' : '') }}
                            </p>
                            <a onclick="openArticleModal('{{$title}}', '{{$content}}', '{{$imgPath}}')">
                                Читать &#8594;
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="process">
        <div class="process__inner">
            <h1>SAPA жол</h1>
            <h3>Сопровождение в процессе</h3>
            <img src="{{asset('images/sapa-zhol-img.png')}}" alt="">
        </div>
    </div>
@endsection
