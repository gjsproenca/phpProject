<?php include './../inc/masterpage-public/header.php'; ?>

<div class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row">

            <!--Map-->
            <div class="col-md-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3112.1051384428206!2d-9.149991018320703!3d38.73834949593829!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xa6833f2027bb59d4!2sCiteforma+-+Centro+de+Forma%C3%A7%C3%A3o+Profissional+dos+Trabalhadores+de+Escrit%C3%B3rio%2C+Com%C3%A9rcio%2C+Servi%C3%A7os+e+Novas+Tecnologias!5e0!3m2!1sen!2spt!4v1528056320966" 
                        width="100%" height="100%" frameborder="0" style="border: 0" allowfullscreen></iframe>
            </div>

            <!--Form-->
            <div class="col-md-6">
                <form method="post" action="success.php">
                    <h1>Contacte-nos</h1>
                    <p>Obrigado pelo seu interesse, responderemos assim que pudermos</p>
                    <div class="form-group">
                        <label for="InputName">Nome</label>
                        <!--TODO: name pattern-->
                        <input class="form-control" name="textBoxName" type="text" placeholder="Introduza o seu nome" MaxLength="100" required>
                    </div>
                    <div class="form-group">
                        <label for="InputEmail1">Endereço de email</label>
                        <input class="form-control" name="textBoxEmail" type="email" placeholder="Introduza o seu endereço de email" MaxLength="70" pattern="\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*" required>
                    </div>
                    <div class="form-group">
                        <label for="Textarea">Mensagem</label>
                        <textarea class="form-control" name="textBoxMessage" Rows="3" placeholder="Introduza a sua mensagem, mínimo 20 carateres, máximo 250" required></textarea>
                    </div>
                    <button class="btn btn-dark text-white" name="submitContacts" OnClick="submit_Click">Submeter</button>
                    <input class="btn btn-dark text-white float-sm-right" id="resetContacts" type="reset" value="Limpar" />
                </form>
            </div>

        </div>
    </div>
</div>

<?php include './../inc/masterpage-public/footer.php'; ?>
