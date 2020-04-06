package com.example.preclarity.faq;

import androidx.appcompat.app.AppCompatActivity;

import android.app.AlertDialog;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.TextView;

import com.example.preclarity.ListChatActivity;
import com.example.preclarity.MenuActivity;
import com.example.preclarity.R;

public class FaqActivity extends AppCompatActivity {
    RadioGroup radioGroupLogement;
    RadioButton radioButtonLogement;
    TextView textViewLogement;
    TextView textViewSanté;
    TextView textViewEtudes;
    Button menu;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_faq);
        radioGroupLogement = findViewById(R.id.radioGroupLogement);
        textViewLogement = findViewById(R.id.text_view_logement);
        textViewSanté = findViewById(R.id.text_view_santé);
        textViewEtudes = findViewById(R.id.text_view_etudes);
        RadioButton r1 = findViewById(R.id.radio_1);
        r1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                //incrémenter le nombre de défaites

                AlertDialog.Builder builder = new AlertDialog.Builder(FaqActivity.this);
                builder.setTitle("Logement");
                builder.setMessage("Il faut pour cela constituer un Dossier Social Étudiant (DSE) sur messervices.etudiant.gouv.fr entre le 15 janvier et le 15 mai. !");

                // add a button
                builder.setPositiveButton("OK", null);

                // create and show the alert dialog
                AlertDialog dialog = builder.create();
                dialog.show();

            }
        });

        RadioButton r2 = findViewById(R.id.radio_2);
        r2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                AlertDialog.Builder builder = new AlertDialog.Builder(FaqActivity.this);
                builder.setTitle("Logement");
                builder.setMessage("Vous devez contacter la CAF (Caisse d'Allocations Familiales) de votre département, en vous rendant sur leur site. Vous trouverez plus d'informations dans la rubrique Logement.");

                // add a button
                builder.setPositiveButton("OK", null);

                // create and show the alert dialog
                AlertDialog dialog = builder.create();
                dialog.show();


            }
        });
        RadioButton r3 = findViewById(R.id.radio_3);
        r3.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {


                AlertDialog.Builder builder = new AlertDialog.Builder(FaqActivity.this);
                builder.setTitle("Santé");
                builder.setMessage("Dorénavant, les mutuelles ont pour obligation d'informer leurs assurés de la possibilité de résilier leur contrat, et ce avant chaque échéance annuelle de prime de cotisation. Les assurés disposent généralement d'un préavis de 2 mois pour résilier leur mutuelle santé.");

                // add a button
                builder.setPositiveButton("OK", null);

                // create and show the alert dialog
                AlertDialog dialog = builder.create();
                dialog.show();


            }
        });
        RadioButton r4 = findViewById(R.id.radio_4);
        r4.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {



                AlertDialog.Builder builder = new AlertDialog.Builder(FaqActivity.this);
                builder.setTitle("Santé");
                builder.setMessage("Depuis le 1er janvier 2016, avec la protection universelle maladie (PUMa), toute personne qui travaille ou réside en France de manière stable et régulière a droit à la prise en charge de ses frais de santé.");

                // add a button
                builder.setPositiveButton("OK", null);

                // create and show the alert dialog
                AlertDialog dialog = builder.create();
                dialog.show();


            }
        });

        RadioButton r5 = findViewById(R.id.radio_5);
        r5.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                AlertDialog.Builder builder = new AlertDialog.Builder(FaqActivity.this);
                builder.setTitle("Etude");
                builder.setMessage("Rends toi sur notre forum pour que tu puisses échanger avec des professeurs !");

                // add a button
                builder.setPositiveButton("OK", null);

                // create and show the alert dialog
                AlertDialog dialog = builder.create();
                dialog.show();

            }
        });

        RadioButton r6 = findViewById(R.id.radio_6);
        r6.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                AlertDialog.Builder builder = new AlertDialog.Builder(FaqActivity.this);
                builder.setTitle("Etude");
                builder.setMessage("Consultez notre plateforme d'aide scolaire en ligne !");

                // add a button
                builder.setPositiveButton("OK", null);

                // create and show the alert dialog
                AlertDialog dialog = builder.create();
                dialog.show();



            }
        });

        menu = (Button) findViewById(R.id.btnMenu);
        menu.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(FaqActivity.this, MenuActivity.class));
                overridePendingTransition(R.anim.slide_in_right, R.anim.slide_out_left);
            }
        });

    }

    public void checkButton(View v) {
        int radioId = radioGroupLogement.getCheckedRadioButtonId();
        //Toast.makeText(this, String.valueOf(radioId), Toast.LENGTH_SHORT).show();



        if(radioId == 2131296387 || radioId == 2131296388) { //Logement
            radioButtonLogement = findViewById(radioId);
            textViewSanté.setText("");
            textViewEtudes.setText("");
            textViewLogement.setText(radioButtonLogement.getTag().toString());

        }else if (radioId == 2131296389 || radioId == 2131296390) { //Santé
            textViewLogement.setText("");
            textViewEtudes.setText("");
            textViewSanté.setText(radioButtonLogement.getTag().toString());
        }else{
            textViewLogement.setText("");
        textViewSanté.setText("");
        textViewEtudes.setText(radioButtonLogement.getTag().toString()); //Etudes
    }
    }
}
