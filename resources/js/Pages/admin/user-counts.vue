<template>
    <div>
      <h1>User Counts</h1>
      <div>
        <p>Employers: {{ employersCount }}</p>
        <p>Candidates: {{ candidatesCount }}</p>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      employersCount: Number,
      candidatesCount: Number
    }
  };
  </script>
  