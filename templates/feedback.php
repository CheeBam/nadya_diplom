<div>
    <h3 class="text-center mb-4">Залишити відгук</h3>

    <form class="form" action="/handlers/admin.php" method="post">
        <input type="hidden" name="operation_type" value="send_feedback">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Ім'я</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Ім'я" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Пошта</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Пошта" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="text">Текст відгуку</label>
                    <textarea rows="4" class="form-control" name="text" id="text" placeholder="Відгук" required></textarea>
                </div>
            </div>
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-success">Відправити</button>
            </div>
        </div>
    </form>


</div>
