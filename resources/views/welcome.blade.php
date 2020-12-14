<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

       <meta charset="UTF-8">
       	<meta name="viewport" content="width=device-width, initial-scale=1.0">
       	<title>Sapa</title>

		<script src="https://kit.fontawesome.com/c9e46db961.js" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="{{asset('landing/styles/style.css')}}">
		<link rel="stylesheet" href="{{asset('landing/slick-1.8.1/slick/slick.css')}}">
		<link rel="stylesheet" href="{{asset('landing/slick-1.8.1/slick/slick-theme.css')}}">

    </head>
<body>
	<div class="body-wrapper">
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
								<a href="{{ route('login') }}">
									Войти
								</a>
							</li>
							<li>
								<a href="{{ route('register') }}">
									Зарегистрироваться
								</a>
							</li>
						</ul>
					</nav>
				</div>
				<div class="menu-toggle"><i class="fas fa-bars"></i></div>
			</div>
		</header>

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
					<a href="#">Пройти тест</a>
				</div>
				<div>
					<p>Пройди тест и определи свою финансовою стратегию!</p>
					<a href="#">Пройти диагностику</a>
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
						<img src="/images/img/community-blog-img.png" alt="">
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.</p>
					</div>
				</div>
				<div class="community__blog-slider">
					<div class="community__blog-slider__for">
						<div>
							<img src="/images/slides/community-slider-img1.png" alt="">
						</div>
						<div>
							<img src="/images/slides/community-slider-img2.png" alt="">
						</div>
						<div>
							<img src="/images/slides/community-slider-img3.png" alt="">
						</div>
						<div>
							<img src="/images/slides/community-slider-img2.png" alt="">
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
					<p>
						Lorem ipsum dolor sit amet consectetur, adipisicing elit. Totam, repellat iste in veniam minima sequi molestiae, rerum aspernatur, consequatur ducimus necessitatibus ab blanditiis repellendus excepturi, porro! Aliquam maxime officia eligendi?
						Reiciendis molestias assumenda deserunt in labore quod vitae alias vero animi nihil illum dolor, dolorum aliquid enim, rerum, totam? Accusamus nemo deleniti cum repudiandae ullam esse nesciunt provident amet sunt! Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum, explicabo veritatis mollitia in laboriosam numquam iste adipisci praesentium, hic magnam molestiae cupiditate saepe, vitae voluptate debitis accusantium iure ea vel. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolores amet, numquam, tempora ipsa ea autem magni sequi ad quod libero placeat vitae rem qui velit saepe. Culpa repellat cum nesciunt?
						Lorem ipsum dolor sit amet consectetur, adipisicing elit. Totam, repellat iste in veniam minima sequi molestiae, rerum aspernatur, consequatur ducimus necessitatibus ab blanditiis repellendus excepturi, porro! Aliquam maxime officia eligendi?
						Reiciendis molestias assumenda deserunt in labore quod vitae alias vero animi nihil illum dolor, dolorum aliquid enim, rerum, totam? Accusamus nemo deleniti cum repudiandae ullam esse nesciunt provident amet sunt! Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum, explicabo veritatis mollitia in laboriosam numquam iste adipisci praesentium, hic magnam molestiae cupiditate saepe, vitae voluptate debitis accusantium iure ea vel. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolores amet, numquam, tempora ipsa ea autem magni sequi ad quod libero placeat vitae rem qui velit saepe. Culpa repellat cum nesciunt?
					</p>
				</div>
			</div>
		</div>

		<div class="founder">
			<div class="founder__inner">
				<div class="founder__main">
					<h1>Об основателе</h1>
					<p>
						Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
						<br><br>
						It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
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
						<div>
							<img src="{{asset('images/icons/academy-slider-img1.png')}}" alt="">
							<h1>Финансовая диагностика</h1>
							<p>
								Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.
							</p>
							<a href="#">Подробнее о курсе</a>
						</div>
						<div>
							<img src="{{asset('images/icons/academy-slider-img1.png')}}" alt="">
							<h1>Курсы, тренинги</h1>
							<p>
								Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.
							</p>
							<a href="#">Подробнее о курсе</a>
						</div>
						<div>
							<img src="{{asset('images/icons/academy-slider-img3.png')}}" alt="">
							<h1>Составление ЛФП</h1>
							<p>
								Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.
							</p>
							<a href="#">Подробнее о курсе</a>
						</div>
						<div>
							<img src="{{asset('images/icons/academy-slider-img3.png')}}" alt="">
							<h1>Курсы, тренинги</h1>
							<p>
								Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.
							</p>
							<a href="#">Подробнее о курсе</a>
						</div>
						<div>
							<img src="{{asset('images/icons/academy-slider-img3.png')}}" alt="">
							<h1>Составление ЛФП</h1>
							<p>
								Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.
							</p>
							<a href="#">Подробнее о курсе</a>
						</div>
						<div>
							<img src="{{asset('images/icons/academy-slider-img1.png')}}" alt="">
							<h1>Финансовая диагностика</h1>
							<p>
								Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.
							</p>
							<a href="#">Подробнее о курсе</a>
						</div>
						<div>
							<img src="{{asset('images/icons/academy-slider-img1.png')}}" alt="">
							<h1>Финансовая диагностика</h1>
							<p>
								Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.
							</p>
							<a href="#">Подробнее о курсе</a>
						</div>
						<div>
							<img src="{{asset('images/icons/academy-slider-img2.png')}}" alt="">
							<h1>Курсы, тренинги</h1>
							<p>
								Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.
							</p>
							<a href="#">Подробнее о курсе</a>
						</div>
						<div>
							<img src="{{asset('images/icons/academy-slider-img3.png')}}" alt="">
							<h1>Составление ЛФП</h1>
							<p>
								Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.
							</p>
							<a href="#">Подробнее о курсе</a>
						</div>
					</div>
				</div>
				<div class="academy__inner__2" id="academy__inner__2">
					<h1>SAPA Market</h1>
					<div class="academy__slider2">
						<div>
							<img src="{{asset('images/icons/academy-slider-img1.png')}}" alt="">
							<h1>Финансовая диагностика</h1>
							<p>
								Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.
							</p>
							<a href="#">Подробнее о курсе</a>
						</div>
						<div>
							<img src="{{asset('images/icons/academy-slider-img2.png')}}" alt="">
							<h1>Курсы, тренинги</h1>
							<p>
								Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.
							</p>
							<a href="#">Подробнее о курсе</a>
						</div>
						<div>
							<img src="{{asset('images/icons/academy-slider-img3.png')}}" alt="">
							<h1>Составление ЛФП</h1>
							<p>
								Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.
							</p>
							<a href="#">Подробнее о курсе</a>
						</div>
						<div>
							<img src="{{asset('images/icons/academy-slider-img2.png')}}" alt="">
							<h1>Курсы, тренинги</h1>
							<p>
								Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.
							</p>
							<a href="#">Подробнее о курсе</a>
						</div>
						<div>
							<img src="{{asset('images/icons/academy-slider-img3.png')}}" alt="">
							<h1>Составление ЛФП</h1>
							<p>
								Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.
							</p>
							<a href="#">Подробнее о курсе</a>
						</div>
						<div>
							<img src="{{asset('images/icons/academy-slider-img1.png')}}" alt="">
							<h1>Финансовая диагностика</h1>
							<p>
								Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.
							</p>
							<a href="#">Подробнее о курсе</a>
						</div>
						<div>
							<img src="{{asset('images/icons/academy-slider-img1.png')}}" alt="">
							<h1>Финансовая диагностика</h1>
							<p>
								Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.
							</p>
							<a href="#">Подробнее о курсе</a>
						</div>
						<div>
							<img src="{{asset('images/icons/academy-slider-img2.png')}}" alt="">
							<h1>Курсы, тренинги</h1>
							<p>
								Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.
							</p>
							<a href="#">Подробнее о курсе</a>
						</div>
						<div>
							<img src="{{asset('images/icons/academy-slider-img3.png')}}" alt="">
							<h1>Составление ЛФП</h1>
							<p>
								Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.
							</p>
							<a href="#">Подробнее о курсе</a>
						</div>
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
						<b>Центр повышения квалификации финансовых консультантов</b> - это обучение и развитие навыков и компитенции профессиональных финансовых советников
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
						<div>
							<p>Якубова Райхан</p>
							<img src="{{asset('images/slides/consultants-consultants-slider-img1.png')}}" alt="">
						</div>
						<div>
							<p>Брасилова Акжунис</p>
							<img src="{{asset('images/slides/consultants-consultants-slider-img2.png')}}" alt="">
						</div>
						<div>
							<p>Булатова Нургуль</p>
							<img src="{{asset('images/slides/consultants-consultants-slider-img3.png')}}" alt="">
						</div>
						<div>
							<p>Атабаева Зарима</p>
							<img src="{{asset('images/slides/consultants-consultants-slider-img4.png')}}" alt="">
						</div>
						<div>
							<p>Якубова Райхан</p>
							<img src="{{asset('images/slides/consultants-consultants-slider-img1.png')}}" alt="">
						</div>
						<div>
							<p>Брасилова Акжунис</p>
							<img src="{{asset('images/slides/consultants-consultants-slider-img2.png')}}" alt="">
						</div>
						<div>
							<p>Булатова Нургуль</p>
							<img src="{{asset('images/slides/consultants-consultants-slider-img3.png')}}" alt="">
						</div>
						<div>
							<p>Атабаева Зарима</p>
							<img src="{{asset('images/slides/consultants-consultants-slider-img4.png')}}" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="articles">
			<div class="articles__wrapper">
				<h1>Статьи</h1>
				<div class="articles__slider">
					<div>
						<div class="articles__slider__slide__inner">
							<img src="{{asset('images/slides/articles-slider-img1.png')}}" alt="">
							<p>
								Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown print...
							</p>
							<a href="#">
								Читать &#8594;
							</a>
						</div>
					</div>
					<div>
						<div class="articles__slider__slide__inner">
							<img src="{{asset('images/slides/articles-slider-img1.png')}}" alt="">
							<p>
								Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown print...
							</p>
							<a href="#">
								Читать &#8594;
							</a>
						</div>
					</div>
					<div>
						<div class="articles__slider__slide__inner">
							<img src="{{asset('images/slides/articles-slider-img1.png')}}" alt="">
							<p>
								Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown print...
							</p>
							<a href="#">
								Читать &#8594;
							</a>
						</div>
					</div>
					<div>
						<div class="articles__slider__slide__inner">
							<img src="{{asset('images/slides/articles-slider-img1.png')}}" alt="">
							<p>
								Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown print...
							</p>
							<a href="#">
								Читать &#8594;
							</a>
						</div>
					</div>
					<div>
						<div class="articles__slider__slide__inner">
							<img src="{{asset('images/slides/articles-slider-img1.png')}}" alt="">
							<p>
								Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown print...
							</p>
							<a href="#">
								Читать &#8594;
							</a>
						</div>
					</div>
					<div>
						<div class="articles__slider__slide__inner">
							<img src="{{asset('images/slides/articles-slider-img1.png')}}" alt="">
							<p>
								Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown print...
							</p>
							<a href="#">
								Читать &#8594;
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="process">
			<div class="process__inner">
				<h1>SAPA жол</h1>
				<h3>Сопровождение в процессе</h3>
				<img src="{{asset('images/img/sapa-zhol-img.png')}}" alt="">
			</div>
		</div>

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
						<li><a href="#"><img src="{{asset('img/icons/footer-social-youtube.png')}}" alt=""></a></li>
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
						<p>info@sapa.kz</p>
					</div>
				</div>
			</div>
		</footer>
		@stack('script')
		<script src="{{asset('landing/scripts/jquery-3.5.1-min.js')}}"></script>
		<script src="{{asset('landing/slick-1.8.1/slick/slick.min.js')}}"></script>
		<script type="text/javascript">

			$(document).ready(function(){
				$('.menu-toggle').click(function(){
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
					dots: true
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
				})
			})
		</script>
	</div>
</body>

</html>
