<template>
  <p class="mb-2">
    Tables are flexible and accept almost any
    <code class="hljs language-pgsql inline-block bg-[#f3f3f3] px-1">
      <span class="hljs-keyword">SELECT</span>
    </code>
    queries.
  </p>

  <p class="mb-4">
    If you wish the data in your table to reflect the date selection from the
    UI, you should include a
    <code class="hljs language-pgsql inline-block bg-[#f3f3f3] px-1"
      ><span class="hljs-keyword">BETWEEN</span> @<span class="hljs-keyword"
        >start</span
      >
      <span class="hljs-keyword"> AND</span> @<span class="hljs-keyword"
        >end</span
      ></code
    >
    filter in your query.
  </p>

  <p class="mb-2">Example:</p>
  <div class="rounded bg-[#f3f3f3] p-4">
    <div class="hljs language-pgsql relative flex-1">
      <span class="hljs-keyword">SELECT</span> name, email, created_at<br />
      <span class="hljs-keyword">FROM</span> users<br />
      <span class="hljs-keyword">WHERE</span> created_at
      <span class="hljs-keyword">BETWEEN</span> @<span class="hljs-keyword"
        >start</span
      >
      <span class="hljs-keyword"> AND</span> @<span class="hljs-keyword"
        >end</span
      ><br />
      <span class="hljs-keyword">ORDER</span>
      <span class="hljs-keyword"> BY</span> created_at
      <span class="hljs-keyword">DESC</span><br />
      <span class="hljs-keyword">LIMIT</span> 5
    </div>
  </div>
</template>
