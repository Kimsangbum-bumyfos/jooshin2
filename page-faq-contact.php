<?php
/**
 * Template Name: FAQ + 문의하기
 */

// 폼 제출 처리
$form_sent    = false;
$form_error   = false;
$form_message = '';

if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset( $_POST['faq_contact_nonce'] ) ) {
    if ( wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['faq_contact_nonce'] ) ), 'faq_contact_action' ) ) {

        $name    = sanitize_text_field( $_POST['contact_name']    ?? '' );
        $company = sanitize_text_field( $_POST['contact_company'] ?? '' );
        $email   = sanitize_email(      $_POST['contact_email']   ?? '' );
        $phone   = sanitize_text_field( $_POST['contact_phone']   ?? '' );
        $message = sanitize_textarea_field( $_POST['contact_message'] ?? '' );

        $errors = [];
        if ( empty( $name ) )    $errors[] = '이름을 입력해 주세요.';
        if ( ! is_email($email) ) $errors[] = '올바른 이메일 주소를 입력해 주세요.';
        if ( empty( $message ) ) $errors[] = '문의 내용을 입력해 주세요.';

        if ( empty( $errors ) ) {
            // $to      = get_option('admin_email'); // 수신 이메일 — 필요시 변경
            $to      = 'help@joosh.co.kr'; // 수신 이메일 — 필요시 변경
            $subject = "[문의] {$name}" . ( $company ? " ({$company})" : '' );
            $body    = "이름: {$name}\n"
                     . ( $company ? "회사명: {$company}\n" : '' )
                     . "이메일: {$email}\n"
                     . ( $phone   ? "연락처: {$phone}\n"   : '' )
                     . "\n문의 내용:\n{$message}";
            $headers = [
                'Content-Type: text/plain; charset=UTF-8',
                "Reply-To: {$name} <{$email}>",
            ];

            if ( wp_mail( $to, $subject, $body, $headers ) ) {
                $form_sent = true;
            } else {
                $form_error   = true;
                $form_message = '메일 전송 중 오류가 발생했습니다. 잠시 후 다시 시도해 주세요.';
            }
        } else {
            $form_error   = true;
            $form_message = implode( ' ', $errors );
        }
    }
}

get_header();
?>

<!---------- STYLES ---------->
<style>
/* ── Google Fonts ───────────────────────────────────────────── */
@import url('https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&family=DM+Serif+Display:ital@0;1&display=swap');

/* ── Reset / Base ───────────────────────────────────────────── */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

/* ── Hero (회사소개와 동일) ──────────────────────────────────── */
.fc-hero {
    background: #333;
    color: #fff;
    text-align: center;
    height: 300px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.fc-hero h1 {
    color: #fff;
    font-size: 36px;
    margin: 0;
    font-family: 'Noto Sans KR', sans-serif;
}

.fc-section {
    font-family: 'Noto Sans KR', sans-serif;
    background: #fff;
    padding: 100px 0 120px;
    min-height: 60vh;
}

.fc-inner {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 32px;
    display: grid;
    grid-template-columns: 1fr 440px;
    gap: 80px;
    align-items: start;
}

/* ── FAQ ────────────────────────────────────────────────────── */
.fc-faq__header {
    margin-bottom: 48px;
}

.fc-faq__eyebrow {
    font-size: 11px;
    font-weight: 500;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: #1a56db;
    margin-bottom: 14px;
    display: block;
}

.fc-faq__title {
    font-size: clamp(36px, 4vw, 52px);
    color: #111;
    line-height: 1.15;
    margin-bottom: 20px;
}

.fc-faq__sub {
    font-size: 15px;
    color: #666;
    line-height: 1.75;
}

/* Accordion */
.fc-accordion { list-style: none; border-top: 1px solid #e0e0e0; }

.fc-accordion__item { border-bottom: 1px solid #e0e0e0; }

.fc-accordion__btn {
    width: 100%;
    background: transparent !important;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    padding: 24px 4px;
    text-align: left;
    font-family: 'Noto Sans KR', sans-serif;
    font-size: 16px;
    font-weight: 500;
    color: #1a1a1a !important;
    transition: color .2s;
    box-shadow: none !important;
    outline: none;
}

.fc-accordion__btn:hover,
.fc-accordion__btn:focus {
    background: transparent !important;
    color: #1a56db !important;
    box-shadow: none !important;
}

.fc-accordion__icon {
    flex-shrink: 0;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    border: 1.5px solid #bbb;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background .2s, border-color .2s, transform .3s;
}

.fc-accordion__icon svg {
    width: 12px;
    height: 12px;
    stroke: #888;
    transition: stroke .2s;
}

.fc-accordion__btn[aria-expanded="true"] .fc-accordion__icon {
    background: #1a56db;
    border-color: #1a56db;
    transform: rotate(45deg);
}

.fc-accordion__btn[aria-expanded="true"] .fc-accordion__icon svg { stroke: #fff; }

.fc-accordion__body {
    overflow: hidden;
    max-height: 0;
    transition: max-height .35s cubic-bezier(.4,0,.2,1);
}

.fc-accordion__body p {
    padding: 4px 4px 28px;
    font-size: 14.5px;
    line-height: 1.85;
    color: #555;
}

/* ── Contact Form Card ──────────────────────────────────────── */
.fc-card {
    background: #fff;
    border-radius: 20px;
    padding: 44px 40px 48px;
    box-shadow: 0 8px 40px rgba(0,0,0,.12);
    position: sticky;
    top: 40px;
}

.fc-card__title {
    font-size: 26px;
    color: #111;
    margin-bottom: 8px;
}

.fc-card__sub {
    font-size: 13px;
    color: #999;
    margin-bottom: 36px;
    line-height: 1.6;
}

/* Fields */
.fc-field { margin-bottom: 20px; }

.fc-field label {
    display: block;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: #888;
    margin-bottom: 8px;
}

.fc-field label .req { color: #e74c3c; margin-left: 2px; }

.fc-field input,
.fc-field textarea {
    width: 100%;
    border: 1.5px solid #e8e6e0;
    border-radius: 10px;
    padding: 13px 16px;
    font-family: 'Noto Sans KR', sans-serif;
    font-size: 14px;
    color: #1a1a1a;
    background: #fafafa;
    outline: none;
    transition: border-color .2s, background .2s, box-shadow .2s;
    resize: none;
}

.fc-field input::placeholder,
.fc-field textarea::placeholder { color: #bbb; }

.fc-field input:focus,
.fc-field textarea:focus {
    border-color: #1a56db;
    background: #fff;
    box-shadow: 0 0 0 4px rgba(26,86,219,.08);
}

.fc-field textarea { min-height: 130px; }

/* Row (name + company) */
.fc-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
}

/* Submit */
.fc-submit {
    margin-top: 28px;
    width: 100%;
    padding: 16px;
    background: #1a56db;
    color: #fff;
    border: none;
    border-radius: 10px;
    font-family: 'Noto Sans KR', sans-serif;
    font-size: 15px;
    font-weight: 700;
    letter-spacing: .5px;
    cursor: pointer;
    transition: background .2s, transform .15s, box-shadow .2s;
}

.fc-submit:hover {
    background: #1344b5;
    box-shadow: 0 6px 20px rgba(26,86,219,.25);
}

.fc-submit:active { transform: scale(.98); }

/* Alerts */
.fc-alert {
    border-radius: 10px;
    padding: 14px 18px;
    font-size: 13.5px;
    margin-bottom: 24px;
    line-height: 1.6;
}

.fc-alert--success {
    background: #edfaf3;
    color: #1a7d4b;
    border: 1px solid #a3e6c0;
}

.fc-alert--error {
    background: #fff2f2;
    color: #b91c1c;
    border: 1px solid #fca5a5;
}

/* Responsive */
@media (max-width: 900px) {
    .fc-inner {
        grid-template-columns: 1fr;
        gap: 60px;
    }
    .fc-card { position: static; }
}

@media (max-width: 560px) {
    .fc-hero { height: 200px; }
    .fc-hero h1 { font-size: 28px; }
    .fc-inner { padding: 0 20px; }
    .fc-card  { padding: 32px 24px 36px; }
    .fc-row   { grid-template-columns: 1fr; }
}
</style>

<!-- 히어로 (회사소개와 동일 구조) -->
<div class="fc-hero" style="background: #333 url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/support.jpg') center/cover;">
    <h1>고객문의</h1>
</div>

<!---------- MARKUP ---------->
<section class="fc-section">
  <div class="fc-inner">

    <!-- ① FAQ -->
    <div class="fc-faq">
      <div class="fc-faq__header">
        <span class="fc-faq__eyebrow">FAQ</span>
        <h2 class="fc-faq__title">자주 묻는질문</h2>
        <p class="fc-faq__sub">
          고객님들께서 자주 문의하시는 내용을 모았습니다.<br>
          원하시는 답변이 없으시면 오른쪽 문의 양식을 이용해 주세요.
        </p>
      </div>

      <?php
      // ── FAQ 데이터 — 여기서 자유롭게 수정하세요 ──────────────
      $faqs = [
          [
              'q' => '주신산업은 어떤 분야의 엔지니어링 서비스를 제공하나요?',
              'a' => '구조 계측, 지반 모니터링, 환경 센서링 등 다양한 엔지니어링 분야에 걸쳐 측정·분석·컨설팅 서비스를 제공합니다. 세부 분야는 별도로 문의해 주시면 상세히 안내해 드립니다.',
          ],
          [
              'q' => '주신산업의 핵심 강점은 무엇인가요?',
              'a' => '20년 이상의 현장 경험을 바탕으로 한 데이터 신뢰성과, 국내외 다수의 대형 프로젝트를 통해 쌓인 기술력이 핵심 강점입니다.',
          ],
          [
              'q' => '어떤 계측 및 모니터링 프로젝트를 수행해 왔나요?',
              'a' => '교량·터널·댐·사면 등 사회기반시설의 구조 안전 모니터링을 비롯해 건설 현장 계측, 진동·소음 측정, 지하수위 모니터링 등 다양한 프로젝트를 수행해 왔습니다.',
          ],
          [
              'q' => '맞춤형 계측 솔루션도 가능한가요?',
              'a' => '네, 가능합니다. 현장 환경과 목적에 맞는 센서 선정부터 데이터 수집 시스템 구축, 원격 모니터링 플랫폼까지 전체 과정을 맞춤 설계해 드립니다.',
          ],
          [
              'q' => '연구개발 및 기술 인증 이력은 어떻게 되나요?',
              'a' => '국토교통부 연구과제 참여, KS·ISO 관련 인증 취득 등 다수의 R&D 및 기술 인증 이력을 보유하고 있습니다. 구체적인 이력은 문의 시 제공해 드립니다.',
          ],
      ];
      ?>

      <ul class="fc-accordion" id="faqAccordion">
        <?php foreach ( $faqs as $i => $faq ) :
            $btn_id  = 'faq-btn-'  . $i;
            $body_id = 'faq-body-' . $i;
        ?>
        <li class="fc-accordion__item">
          <button
            class="fc-accordion__btn"
            id="<?php echo esc_attr( $btn_id ); ?>"
            aria-expanded="false"
            aria-controls="<?php echo esc_attr( $body_id ); ?>"
          >
            <?php echo esc_html( $faq['q'] ); ?>
            <span class="fc-accordion__icon" aria-hidden="true">
              <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            </span>
          </button>
          <div
            class="fc-accordion__body"
            id="<?php echo esc_attr( $body_id ); ?>"
            role="region"
            aria-labelledby="<?php echo esc_attr( $btn_id ); ?>"
          >
            <p><?php echo esc_html( $faq['a'] ); ?></p>
          </div>
        </li>
        <?php endforeach; ?>
      </ul>
    </div><!-- /.fc-faq -->

    <!— ② Contact Form —>
    <div class="fc-card">
      <h3 class="fc-card__title">문의하기</h3>
      <p class="fc-card__sub">담당자가 영업일 기준 1~2일 내로 답변 드립니다.</p>

      <?php if ( $form_sent ) : ?>
        <div class="fc-alert fc-alert--success" role="alert">
          ✅ 문의가 성공적으로 접수되었습니다. 빠른 시일 내에 답변 드리겠습니다.
        </div>
      <?php elseif ( $form_error ) : ?>
        <div class="fc-alert fc-alert--error" role="alert">
          ⚠️ <?php echo esc_html( $form_message ); ?>
        </div>
      <?php endif; ?>

      <?php if ( ! $form_sent ) : ?>
      <form method="POST" action="<?php echo esc_url( get_permalink() ); ?>" novalidate>
        <?php wp_nonce_field( 'faq_contact_action', 'faq_contact_nonce' ); ?>

        <div class="fc-row">
          <div class="fc-field">
            <label for="contact_name">이름 <span class="req">*</span></label>
            <input
              type="text"
              id="contact_name"
              name="contact_name"
              placeholder="홍길동"
              value="<?php echo esc_attr( $_POST['contact_name'] ?? '' ); ?>"
              required
            >
          </div>
          <div class="fc-field">
            <label for="contact_company">회사명</label>
            <input
              type="text"
              id="contact_company"
              name="contact_company"
              placeholder="(선택)"
              value="<?php echo esc_attr( $_POST['contact_company'] ?? '' ); ?>"
            >
          </div>
        </div>

        <div class="fc-field">
          <label for="contact_email">이메일 <span class="req">*</span></label>
          <input
            type="email"
            id="contact_email"
            name="contact_email"
            placeholder="email@example.com"
            value="<?php echo esc_attr( $_POST['contact_email'] ?? '' ); ?>"
            required
          >
        </div>

        <div class="fc-field">
          <label for="contact_phone">연락처</label>
          <input
            type="tel"
            id="contact_phone"
            name="contact_phone"
            placeholder="010-0000-0000"
            value="<?php echo esc_attr( $_POST['contact_phone'] ?? '' ); ?>"
          >
        </div>

        <div class="fc-field">
          <label for="contact_message">문의 내용 <span class="req">*</span></label>
          <textarea
            id="contact_message"
            name="contact_message"
            placeholder="문의하실 내용을 입력해 주세요."
            required
          ><?php echo esc_textarea( $_POST['contact_message'] ?? '' ); ?></textarea>
        </div>

        <button type="submit" class="fc-submit">문의 보내기 →</button>
      </form>
      <?php endif; ?>
    </div><!-- /.fc-card -->

  </div><!-- /.fc-inner -->
</section>

<!---------- SCRIPTS ---------->
<script>
(function () {
  // Accordion
  const btns = document.querySelectorAll('.fc-accordion__btn');

  btns.forEach(function (btn) {
    btn.addEventListener('click', function () {
      const expanded = btn.getAttribute('aria-expanded') === 'true';
      const body     = document.getElementById( btn.getAttribute('aria-controls') );

      // 다른 항목 닫기
      btns.forEach(function (b) {
        if ( b !== btn ) {
          b.setAttribute('aria-expanded', 'false');
          const ob = document.getElementById( b.getAttribute('aria-controls') );
          if (ob) ob.style.maxHeight = '0';
        }
      });

      // 현재 항목 토글
      if ( expanded ) {
        btn.setAttribute('aria-expanded', 'false');
        body.style.maxHeight = '0';
      } else {
        btn.setAttribute('aria-expanded', 'true');
        body.style.maxHeight = body.scrollHeight + 'px';
      }
    });
  });
})();
</script>

<?php get_footer(); ?>