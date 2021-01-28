@extends('layouts.guest')
@section('content')
<div id="about" style="background: none;">
    <div class="wrapper" style="background: none;">
        <div class="inner page-course-inner">
        	<a href="/" class="back-button">
        		<svg style="margin-top: -2.5px;" xmlns="http://www.w3.org/2000/svg" width="7" height="12" viewBox="0 0 7 12" fill="none">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M6.58934 0.410093C6.91477 0.73553 6.91477 1.26317 6.58934 1.5886L2.17859 5.99935L6.58934 10.4101C6.91477 10.7355 6.91477 11.2632 6.58934 11.5886C6.2639 11.914 5.73626 11.914 5.41083 11.5886L0.410826 6.58861C0.0853888 6.26317 0.0853888 5.73553 0.410826 5.41009L5.41083 0.410093C5.73626 0.0846564 6.2639 0.0846564 6.58934 0.410093Z" />
				</svg> 
				Вернуться назад
        	</a>
            <h2 style="margin-top: 20px; font-weight: 600; font-size: 36px;">{{  $course->title }}</h2>
            <p>
            	Lorem, ipsum dolor sit amet consectetur adipisicing elit. Vero labore, consequatur explicabo corrupti ipsa deleniti reprehenderit deserunt accusamus aspernatur natus, veritatis harum doloremque aperiam quia distinctio dicta aut atque doloribus porro ex! Molestiae, dolorum vel quod nostrum quibusdam itaque in, voluptatibus, obcaecati magnam, ab omnis voluptatem id cumque laboriosam ipsam repellendus sequi maxime voluptatum aliquam aspernatur dicta tenetur earum optio laborum repudiandae? Vel officiis rerum, facilis minima nemo numquam, corrupti asperiores doloremque ex facere iure dolorum voluptates accusamus! Vitae repellat suscipit cumque totam explicabo maxime in dicta accusantium voluptatibus nesciunt enim illo laboriosam, porro perspiciatis nobis error voluptates alias voluptas?
            </p>
            <p>
            	Lorem, ipsum dolor sit amet consectetur adipisicing elit. Vero labore, consequatur explicabo corrupti ipsa deleniti reprehenderit deserunt accusamus aspernatur natus, veritatis harum doloremque aperiam quia distinctio dicta aut atque doloribus porro ex! Molestiae, dolorum vel quod nostrum quibusdam itaque in, voluptatibus, obcaecati magnam, ab omnis voluptatem id cumque laboriosam ipsam repellendus sequi maxime voluptatum aliquam aspernatur dicta tenetur earum optio laborum repudiandae? Vel officiis rerum, facilis minima nemo numquam, corrupti asperiores doloremque ex facere iure dolorum voluptates accusamus! Vitae repellat suscipit cumque totam explicabo maxime in dicta accusantium voluptatibus nesciunt enim illo laboriosam, porro perspiciatis nobis error voluptates alias voluptas? Molestiae, dolorum vel quod nostrum quibusdam itaque in, voluptatibus, obcaecati magnam, ab omnis voluptatem id cumque laboriosam ipsam repellendus sequi maxime voluptatum aliquam aspernatur dicta tenetur earum optio laborum repudiandae? Vel officiis rerum, facilis minima nemo numquam, corrupti asperiores doloremque ex facere iure dolorum voluptates accusamus! Vitae repellat suscipit cumque totam explicabo maxime in dicta accusantium voluptatibus nesciunt enim illo laboriosam, porro perspiciatis nobis error voluptates alias voluptas?
            </p>
            <img style="width: 100%;" src="../../images/bgs/articles-bg.jpg" alt="">
        </div>
    </div>
</div>
@endsection
