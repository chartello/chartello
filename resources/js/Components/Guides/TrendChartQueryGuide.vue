<template>
  <p class="mb-2">When writing a query for a trend chart, you should:</p>

  <ul class="mb-6 list-inside list-disc">
    <li>Select a date value aliased as <strong>x</strong></li>
    <li>Select a numeric value aliased as <strong>y</strong></li>
    <li>
      Include a
      <code class="hljs language-pgsql inline-block bg-[#f3f3f3] px-1"
        ><span class="hljs-keyword">BETWEEN</span> @<span class="hljs-keyword"
          >start</span
        >
        <span class="hljs-keyword"> AND</span> @<span class="hljs-keyword"
          >end</span
        ></code
      >
      filter
    </li>
  </ul>

  <p class="mb-2">Example:</p>
  <div class="rounded bg-[#f3f3f3] p-4">
    <div class="hljs language-pgsql relative flex-1">
      <span class="hljs-keyword">SELECT</span> COUNT(*)
      <span class="hljs-keyword">AS</span> y,<br />
      <span class="hljs-type">DATE</span>(created_at)
      <span class="hljs-keyword">AS</span> x<br />
      <span class="hljs-keyword">FROM</span> users<br />
      <span class="hljs-keyword">WHERE</span> created_at
      <span class="hljs-keyword">BETWEEN</span> @<span class="hljs-keyword"
        >start</span
      >
      <span class="hljs-keyword"> AND</span> @<span class="hljs-keyword"
        >end</span
      ><br />
      <span class="hljs-keyword">GROUP</span>
      <span class="hljs-keyword"> BY</span> x<br />
      <span class="hljs-keyword">ORDER</span>
      <span class="hljs-keyword"> BY</span> x
      <span class="hljs-keyword">ASC</span><br />
    </div>
  </div>
</template>
