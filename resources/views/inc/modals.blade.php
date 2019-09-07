<!-- Modals -->
  <!-- add students -->
  <div class="modal fade" id="add-stud" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-light">
          <h2 class="modal-title text-center text-muted ml-auto">Add Students</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="close" id="add-stud-x">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body bg-light">
          <div class="container">
            <div class="row">
              <div class="col-12">
                <form id="add-stud-form">
                  <div id="add-stud-feedback" style="position:absolute;top:0;left:0;width:100%"></div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="name" id="stud-name" placeholder="Name">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="student_id" id="stud-index" placeholder="Index">
                  </div>
                  <div class="form-group">
                    <select class="form-control" name="dep" id="stud-dep">
                      <option value="" disabled selected>Department</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <select class="form-control" name="year" id="stud-year">
                      <option value="" disabled selected>Year</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <div class="row mt-5">
                      <div class="col">
                        <button class="btn btn-secondary btn-block" type="button" id="stud-add-btn">Add</button>
                      </div>
                      <div class="col">
                        <button class="btn btn-secondary btn-block" type="button" id="stud-reset-btn">Reset</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- add results -->
  <div class="modal fade" id="add-results" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-light">
          <h2 class="modal-title text-center text-muted ml-auto">Add Results</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="close" id="add-results-x">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body bg-light">
          <div class="container">
            <div class="row">
              <div class="col-12">
                <form id="add-results-form">
                  <div id="add-results-feedback" style="position:absolute;top:0;left:0;width:100%"></div>
                  <div class="form-group">
                    <select class="form-control" name="dep" id="result-student">
                      <option value="" disabled selected>Select student</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <select class="form-control" name="subject" id="result-subject">
                      <option value="" disabled selected>Select subject</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="name" id="result-grade" placeholder="Grade">
                  </div>
                  <div class="form-group">
                    <div class="row mt-5">
                      <div class="col">
                        <button class="btn btn-secondary btn-block" type="button" id="results-add-btn">Add</button>
                      </div>
                      <div class="col">
                        <button class="btn btn-secondary btn-block" type="button" id="results-reset-btn">Reset</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- add subjects -->
  <div class="modal fade" id="add-subjects" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-light">
          <h2 class="modal-title text-center text-muted ml-auto">Add Subjects</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="close" id="add-subjects-x">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body bg-light">
          <div class="container">
            <div class="row">
              <div class="col-12">
                <form id="add-subjects-form">
                  <div id="add-subjects-feedback" style="position:absolute;top:0;left:0;width:100%"></div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="name" id="subject-name" placeholder="subject name">
                  </div>
                  <div class="form-group">
                    <select class="form-control" name="dep" id="subject-dep">
                      <option value="" disabled selected>Department</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <select class="form-control" name="sem" id="subject-semester">
                      <option value="" disabled selected>Semester</option>
                      <option value="1">First</option>
                      <option value="2">Second</option>
                      <option value="3">Third</option>
                      <option value="4">Fourth</option>
                      <option value="5">Fifth</option>
                      <option value="6">Sixth</option>
                      <option value="7">Seventh</option>
                      <option value="8">Eighth</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <select class="form-control" name="year" id="subject-year">
                      <option value="" disabled selected>Year</option>
                      <option value="First">First</option>
                      <option value="Second">Second</option>
                      <option value="Third">Third</option>
                      <option value="Fourth">Fourth</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <div class="row mt-5">
                      <div class="col">
                        <button class="btn btn-secondary btn-block" type="button" id="subjects-add-btn">Add</button>
                      </div>
                      <div class="col">
                        <button class="btn btn-secondary btn-block" type="button" id="subjects-reset-btn">Reset</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>