<!-- General Elements Content -->
<form id="game-edit-form-post" method="POST" enctype="multipart/form-data" class="form-horizontal form-bordered">
    <input name="_token" value="<%= token %>" hidden>
    <input name="_method" value="<%= method %>" hidden>
    <div class="form-group">
        <label class="col-md-3 control-label" for="name">Name</label>
        <div class="col-md-8">
            <input type="text" id="name" name="name" class="form-control" value="<%= data.name %>" placeholder="Name">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label" for="file">Game File</label>
        <div class="col-md-8">
            <input type="file" id="file" name="file" class="form-control" value="" placeholder="Game File">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label" for="slug">Slug</label>
        <div class="col-md-8">
            <input type="text" id="slug" name="slug" class="form-control" value="<%= data.slug %>" placeholder="Slug">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label" for="logo">Logo</label>
        <div class="col-md-8">
            <input type="file" id="logo" name="logo" class="form-control" value="<%= data.logo %>" placeholder="Logo">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label" for="cover">Cover</label>
        <div class="col-md-8">
            <input type="file" id="cover" name="cover" class="form-control" value="<%= data.cover %>" placeholder="Cover">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label" for="thumb_share">Thumb Share</label>
        <div class="col-md-8">
            <input type="file" id="thumb_share" name="thumb_share" class="form-control" value="<%= data.thumb_share %>" placeholder="Thumb Share">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label" for="description">Description</label>
        <div class="col-md-8">
            <textarea id="description" name="description" rows="5" class="form-control" value="<%= data.description %>" placeholder="Description.."></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label" for="status">Status</label>
        <div class="col-md-8">
            <input type="text" id="status" name="status" class="form-control" value="<%= data.status %>" placeholder="Status">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-8">
            <input type="submit" name="submit" value="Add">
        </div>
    </div>
</form>
