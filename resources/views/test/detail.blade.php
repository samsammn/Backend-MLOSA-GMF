<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>MLOSA FORM</title>
  </head>
  <body>

    <div class="container-fluid col-md-10">
        <div class="h2 mt-4">
            MLOSA FORM

            <form action="/detail" method="GET">
                <div class="form-group mt-4">
                    <select class="form-control" name="mp">
                        @foreach ($maintenance as $item)
                            @if ($item->name == $mp)
                                <option selected>{{ $item->name }}</option>
                            @else
                                <option>{{ $item->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" value="Kirim" class="btn btn-primary">
                </div>
            </form>
            {{ $mp }}
            <hr class="my-4">
        </div>

        @if (isset($mp))
            <form action="/detail" method="POST">
                @csrf

                <div class="form-group row container">
                    <input type="text" class="form-control col-md-2 mr-2 mb-3" placeholder="Observation No" name="observation_no">
                    <input type="text" class="form-control col-md-2 mr-2 mb-3" placeholder="Observation Date" name="observation_date">
                    <input type="text" class="form-control col-md-2 mr-2 mb-3" placeholder="Start Time" name="start_time">
                    <input type="text" class="form-control col-md-2 mr-2 mb-3" placeholder="End Time" name="end_time">
                    <input type="text" class="form-control col-md-3 mr-2 mb-3" placeholder="Component Type" name="component_type">
                    <input type="text" class="form-control col-md-5 mr-2 mb-3" placeholder="Task Observed" name="task_observed">
                    <input type="text" class="form-control col-md-6 mb-3" placeholder="Location" name="location">
                </div>

                @foreach ($maintenance_detail as $item)
                <div class="form-group row jumbotron">
                    <input type="text" class="form-control col-md-1 mr-3 mb-3" name="id_mp_detail[]" value="{{ $item->id_mp_detail }}">
                    <input type="text" class="form-control col-md-3 mr-3 mb-3" value="{{ $item->activity_name }}">
                    <input type="text" class="form-control col-md-7 mb-3" value="{{ $item->sub_activity_name }}">
                    <select class="form-control col-md-3 mr-3 mb-3" name="safety_risk[]">
                        <option>At Risk</option>
                        <option>Safe</option>
                        <option>Not Applicable</option>
                        <option>Did Not Observed</option>
                    </select>
                    <select class="form-control col-md-4 mr-3 mb-3" name="effectively_managed[]">
                        <option value="Y">Yes</option>
                        <option value="N">No</option>
                    </select>
                    <select class="form-control col-md-4" name="error_outcome[]">
                        <option value="1">Inqonsequential</option>
                        <option value="2">Undesired state</option>
                        <option value="3">Additional error & Remarks</option>
                    </select>
                    <select class="form-control col-md-11" name="sub_threat[]">
                    @foreach ($sub_threat as $item)
                            <option value="{{ $item->code }}">{{ $item->code }} {{ $item->description }}</option>
                    @endforeach
                    </select>
                </div>
                @endforeach

                <div class="form-group">
                    <input type="submit" value="Simpan" class="btn btn-primary">
                </div>
            </form>
        @endif
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
