<?php
/**
 * Template Name: 회사소개
 */
get_header(); 
?>
<!-- AOS 라이브러리 -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script> 
<style>
/* ===== 회사소개 페이지 ===== */

/* 히어로 - 전체 너비 */
.about-header {
    
    background: #333;
    color: #fff;
    text-align: center;
    height: 300px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.about-header h1 {
    color: #fff;
    font-size: 36px;
    margin: 0;
}

/* 컨테이너 */
.about-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* 소개 내용 */
.about-content {
    padding: 60px 0;
}
.about-intro {
    text-align: center;
    margin-bottom: 50px;
}
.about-intro h2 {
    font-size: 28px;
    margin-bottom: 20px;
}
.about-intro p {
    font-size: 16px;
    line-height: 1.8;
    color: #666;
}

/* 정보 그리드 */
.about-info-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}
.about-info-item {
    text-align: center;
    padding: 30px 20px;
    background: #f8f9fa;
    border-radius: 10px;
}
.about-info-item .icon {
    width: 50px;
    height: 50px;
    margin: 0 auto 15px;
    background: #255E99;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}
.about-info-item .icon svg {
    width: 24px;
    height: 24px;
    stroke: #fff;
}
.about-info-item h3 {
    font-size: 18px;
    margin-bottom: 10px;
}
.about-info-item p {
    font-size: 14px;
    color: #666;
    line-height: 1.6;
}

/* 오시는 길 */
.about-location {
    padding: 60px 0;
    background: #f8f9fa;
}
.about-location h2 {
    font-size: 28px;
    text-align: center;
    margin-bottom: 40px;
}
.location-wrap {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
}
.location-map {
    border-radius: 10px;
    overflow: hidden;
}
.location-info {
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.info-item {
    margin-bottom: 20px;
}
.info-item strong {
    display: block;
    font-size: 14px;
    color: #999;
    margin-bottom: 5px;
}
.info-item p {
    font-size: 16px;
    color: #333;
    margin: 0;
}

.about-feature {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 50px;
    align-items: center;
    margin-top: 100px;
    margin-bottom: 50px;
}
.feature-image {
    border-radius: 10px;
    overflow: hidden;
}
.feature-image img {
    width: 100%;
    height: auto;
    display: block;
}
.feature-text h3 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #333;
}
.feature-text p {
    font-size: 15px;
    line-height: 1.8;
    color: #666;
    margin-bottom: 15px;
}
.feature-text ul {
    list-style: none;
    padding: 0;
    margin: 20px 0 0;
}
.feature-text ul li {
    position: relative;
    padding-left: 20px;
    margin-bottom: 10px;
    font-size: 15px;
    color: #333;
}
.feature-text ul li::before {
    content: '';
    position: absolute;
    left: 0;
    top: 8px;
    width: 8px;
    height: 8px;
    background: #255E99;
    border-radius: 50%;
}

/* 모바일 추가 */
@media (max-width: 768px) {
    .about-feature {
        grid-template-columns: 1fr;
        gap: 30px;
    }
}

/* 모바일 */
@media (max-width: 768px) {
    .about-header {
        height: 200px;
    }
    .about-header h1 {
        font-size: 28px;
    }
    .about-content {
        padding: 40px 0;
    }
    .about-info-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    .location-wrap {
        grid-template-columns: 1fr;
    }
    .location-map iframe {
        height: 300px !important;
    }
}
</style>

<!-- 히어로 (컨테이너 밖) -->
<div class="about-header" style="background: #333 url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/company.png') center/cover;">
    <h1>회사소개</h1>
</div>

<!-- 회사 소개 내용 -->
<div class="about-container">
    <div class="about-content">
        <div class="about-intro" data-aos="fade-up">
            <h2>회사소개</h2>
            <p>
               <b>
                정밀 계측으로 산업과 사회의 안전을 지키다<br>
                측정의 신뢰, 미래의 혁신<br>
                세계적 기술, 국내 맞춤 솔루션<br>
                KYOWA와 함께하는 정밀 계측의 미래<br>
                데이터로 안전을, 기술로 가치를
               </b>
            </p>
        </div>
        
        <div class="about-info-grid">
            <div class="about-info-item" data-aos="fade-up" data-aos-delay="0">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12,6 12,12 16,14"></polyline></svg>
                </div>
                <h3>설립연도</h3>
                <p>2008년 설립<br>20년 이상의 경험</p>
            </div>
            <div class="about-info-item" data-aos="fade-up" data-aos-delay="100">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </div>
                <h3>전문 인력</h3>
                <p>계측 분야 전문가<br>기술 지원팀 운영</p>
            </div>
            <div class="about-info-item" data-aos="fade-up" data-aos-delay="200">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26 12,2"></polygon></svg>
                </div>
                <h3>계측 경험</h3>
                <p>다양한 분야에서<br>수행 이력</p>
            </div>
        </div>

        <!-- about-intro 아래에 추가 -->

        <div class="about-feature" data-aos="fade-up" data-aos-delay="100">
            <div class="feature-image">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/about2.jpg" alt="주신산업">
            </div>
            <div class="feature-text">
                <h3>정밀 계측은 산업의 발전과 사회의 안전을 지탱하는 <br>핵심 기술입니다.</h3>
                <p>
                    주신산업은 정밀 계측 및 센서 분야의 전문 기업으로서, 신뢰할 수 있는 기술과 품질을 바탕으로 고객의 성공적인 비즈니스를 지원해 왔습니다.


                </p>
                <p>
                  <b> 세계적인 정밀 계측 센서 전문 기업 KYOWA와의 협력을 통해, 주신산업은 제품 공급 체계를 한층 강화하였습니다. 이를 통해 글로벌 시장에서 기술력과 품질을 인정받은 KYOWA의 우수한 제품을 국내 고객 여러분께 안정적으로 제공하고 있습니다.</b>

                </p>
                 <p>
                 KYOWA는 오랜 연구 개발과 풍부한 현장 적용 경험을 바탕으로, 다양한 연구기관과 산업 현장에서 검증된 계측 기술을 보유한 기업입니다. 주신산업은 이러한 세계적 수준의 제품을 국내 환경에 맞는 서비스와 기술 지원과 함께 제공함으로써, 고객이 보다 높은 신뢰성과 성능을 직접 경험할 수 있도록 노력하고 있습니다.



                </p>
                    <p>
                주신산업은 KYOWA와 함께 “측정을 통해 사회와 미래를 만든다”는 가치를 공유하며, 산업 현장의 안전과 혁신을 위한 든든한 파트너가 되겠습니다.
                </p>
                <p>
                    <b>주신산업은 데이터로 안전을 기술로 가치를 창출하는 기업이 되겠습니다.</b>
                </p>
                 <p>
                 감사합니다.


                </p>
                <!-- <ul>
                    <li>스트레인게이지 전문 유통</li>
                    <li>맞춤형 계측 솔루션 제공</li>
                    <li>기술 지원 및 교육 서비스</li>
                </ul> -->
            </div>
        </div>
    </div>
</div>

<!-- 오시는 길 (전체 너비 배경) -->
<div class="about-location">
    <div class="about-container">
        <h2>오시는 길</h2>
        <div class="location-wrap">
            <div class="location-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3168.018373875536!2d127.16675318564822!3d37.43667071020341!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x357ca9274bc370e7%3A0xd7356a920dd36000!2zKOyjvCnso7zsi6DsgrDsl4U!5e0!3m2!1sko!2skr!4v1772066984407!5m2!1sko!2skr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="location-info">
                <div class="info-item">
                    <strong>주소</strong>
                    <p>경기도 성남시 중원구 사기막골로 45번길 14 우림라이온스밸리 2차 A동 803호</p>
                </div>
                <div class="info-item">
                    <strong>전화번호</strong>
                    <p>02-774-0622~5</p>
                </div>
                <div class="info-item">
                    <strong>이메일</strong>
                    <p>help@joosh.co.kr</p>
                </div>
                <div class="info-item">
                    <strong>영업시간</strong>
                    <p>평일 09:00 - 18:00 (토/일/공휴일 휴무)</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    AOS.init({
        duration: 800,
        once: true
    });
</script>

<?php get_footer(); ?>