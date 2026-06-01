<section class="ibn-dashboard-hero">
    <div>
        <p class="ibn-dashboard-hero__eyebrow">Control center</p>
        <h1>Powering IBNTECH's digital content and publishing operations.</h1>
        <p class="ibn-dashboard-hero__description">
            From pages and blogs to case studies and lead submissions, manage every aspect of the website through one unified control center.
        </p>
    </div>

    <div class="ibn-dashboard-hero__metrics">
        <article>
            <span>Published</span>
            <strong>{{ number_format($published) }}</strong>
            <p>Live pages, posts, downloads, and case studies</p>
        </article>
        <article>
            <span>Drafts</span>
            <strong>{{ number_format($drafts) }}</strong>
            <p>Items waiting for editorial review or launch</p>
        </article>
        <article>
            <span>Submissions</span>
            <strong>{{ number_format($leadCount) }}</strong>
            <p>Total captured form submissions across the site</p>
        </article>
    </div>
</section>
