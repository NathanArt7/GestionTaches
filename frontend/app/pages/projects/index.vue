<template>
  <div>
    <h1>Dashboard</h1>

    <p>Total projets : {{ dashboard?.total_projects }}</p>
    <p>Total tâches : {{ dashboard.total_tasks }}</p>
    <p>Tâches terminées : {{ dashboard.completed_tasks }}</p>
    <p>Tâches en cours : {{ dashboard.in_progress_tasks }}</p>
  </div>
</template>

<script setup>
const { data: dashboard } = await useFetch(
  'http://127.0.0.1:8000/api/dashboard'
)
</script>