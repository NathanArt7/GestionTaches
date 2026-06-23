<template>
  <div>
    <h1>Liste des projets</h1>

    <table border="1">
      <thead>
        <tr>
          <th>ID</th>
          <th>Titre</th>
          <th>Description</th>
          <th>Date début</th>
          <th>Date fin</th>
          <th>Actions</th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="project in projects" :key="project.id">
          <td>{{ project.id }}</td>
          <td>{{ project.titre }}</td>
          <td>{{ project.description }}</td>
          <td>{{ project.date_debut }}</td>
          <td>{{ project.date_fin }}</td>
           <td>
           <button @click="navigateTo(`/projects/${project.id}/edit`)">
            Modifier
          </button>
         <button @click="deleteProject(project.id)">
          Supprimer
         </button>
         </td>
        </tr>
      </tbody>
    </table>
    <NuxtLink to="/projects/create">
      ➕ Nouveau Projet
    </NuxtLink>
  </div>
</template>

<script setup>
const { data: projects } = await useFetch(
  'http://127.0.0.1:8000/api/projects'
)
const deleteProject = async (id) => {
   await $fetch(`http://127.0.0.1:8000/api/projects/${id}`, {
    method: 'DELETE'
  })

  location.reload()
}
</script>