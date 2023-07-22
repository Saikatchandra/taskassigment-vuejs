<template>
  <div>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Task List</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Task List</li>
              </ol>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->

      <section class="content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Task List</h3>
                  <div class="text-right">
                    <router-link
                      to="/addTask"
                      class="btn btn-primary btn-sm"
                      >Add Task
                    </router-link>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Task Name</th>
                        <th>Description</th>
                        <th>Deadline</th>
                        <th>Assigned user</th>
                        <th style="width: 40px">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(taskList, index) in getTaskList"
                        :key="taskList.id"
                      >

                        <td>{{ index + 1 }}</td>
                        <td>{{ taskList.title }}</td>
                        <td>{{ taskList.description }}</td>
                        <td>{{ taskList.deadline }}</td>
                        <td>{{ taskList.user ? taskList.user.name : 'none'  }}</td>
                        <td>
                          <div class="">
                            <router-link
                              :to="`/assign-task-to-user/${taskList.id}`"
                              class="btn btn-sm btn-primary pr-2"
                            >
                              <i class="fa fa-plus"></i>
                            </router-link>
                            <router-link
                              :to="`/edittask/${taskList.id}`"
                              class="btn btn-sm btn-primary pr-2"
                            >
                              <i class="fa fa-edit"></i>
                            </router-link>
                            <a
                              @click.prevent="removeTask(taskList.id)"
                              class="btn btn-sm btn-danger"
                            >
                              <i class="fa fa-trash"></i>
                            </a>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                  <ul class="pagination pagination-sm m-0 float-right">
                    <li class="page-item">
                      <a class="page-link" href="#">&laquo;</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">&raquo;</a>
                    </li>
                  </ul>
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>

      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
  </div>
</template>

<script>
export default {
  name: "index",

  mounted() {
    this.$store.dispatch("getTaskList");
  },
  computed: {
    getTaskList() {
      console.log('dd',this.$store.getters.taskList)
      return this.$store.getters.taskList;
    },
  },

  methods: {
    removeTask(id) {
      axios
        .get("/deleteTask/" + id)
        .then((res) => {
          this.$store.dispatch("getTaskList");
          Toast.fire({
            icon: "success",
            title: "Task deleted successfully",
          });
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>

<style lang="scss" scoped>
</style>