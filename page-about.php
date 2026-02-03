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
<div class="about-header" style="background: #333 url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/company.jpg') center/cover;">
    <h1>회사소개</h1>
</div>

<!-- 회사 소개 내용 -->
<div class="about-container">
    <div class="about-content">
        <div class="about-intro" data-aos="fade-up">
            <h2>주신산업을 소개합니다</h2>
            <p>
                주신산업은 산업 현장을 위한 정밀 계측 솔루션을 제공하는 전문 기업입니다.<br>
                스트레인게이지, 센서, 계측 시스템 등 다양한 제품과 서비스를 통해<br>
                고객의 정확한 계측 요구에 부응하고 있습니다.
            </p>
        </div>
        
        <div class="about-info-grid">
            <div class="about-info-item" data-aos="fade-up" data-aos-delay="0">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12,6 12,12 16,14"></polyline></svg>
                </div>
                <h3>설립연도</h3>
                <p>2000년 설립<br>20년 이상의 경험</p>
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
                <h3>품질 인증</h3>
                <p>ISO 9001 인증<br>품질 관리 시스템</p>
            </div>
        </div>

        <!-- about-intro 아래에 추가 -->

        <div class="about-feature" data-aos="fade-up" data-aos-delay="100">
            <div class="feature-image">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/about.jpg" alt="주신산업">
            </div>
            <div class="feature-text">
                <h3>정밀 계측의 파트너</h3>
                <p>
                    주신산업은 1990년 설립 이래 스트레인게이지, 센서, 계측 시스템 분야에서 
                    축적된 기술력과 노하우를 바탕으로 고객에게 최적의 솔루션을 제공하고 있습니다.
                </p>
                <p>
                    국내외 유수 기업들과의 파트너십을 통해 최신 기술을 도입하고, 
                    철저한 품질 관리 시스템으로 신뢰할 수 있는 제품을 공급합니다.
                </p>
                <ul>
                    <li>스트레인게이지 전문 유통</li>
                    <li>맞춤형 계측 솔루션 제공</li>
                    <li>기술 지원 및 교육 서비스</li>
                </ul>
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
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d941.8618053718731!2d127.16937010327673!3d37.436328416658306!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x357ca9274bc370e7%3A0xf2938436cec11731!2z6rK96riw64-EIOyEseuCqOyLnCDspJHsm5Dqtawg7IKs6riw66eJ6rOo66GcNDXrsojquLggMTQ!5e0!3m2!1sko!2skr!4v1769412011392!5m2!1sko!2skr" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <div class="location-info">
                <div class="info-item">
                    <strong>주소</strong>
                    <p>경기도 성남시 중원구 사기막골로45번길 14</p>
                </div>
                <div class="info-item">
                    <strong>전화번호</strong>
                    <p>031-123-4567</p>
                </div>
                <div class="info-item">
                    <strong>이메일</strong>
                    <p>info@jooshin.com</p>
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