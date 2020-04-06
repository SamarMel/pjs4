package com.example.preclarity;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.graphics.drawable.BitmapDrawable;
import android.media.Image;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.Window;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.TextView;

import com.example.preclarity.Forum.Topic;
import com.example.preclarity.chat.ConversationActivity;

import org.w3c.dom.Text;

import java.util.List;
import java.util.concurrent.ExecutionException;

public class TopicActivity extends AppCompatActivity {

    private static final String TAG = "TopicActivity";
    private ListView listPosts;
    private Button commentBtn;
    private int idTopic;
    private TextView sujet;
    private ImageView photo;
    private TextView content;
    private TextView date;
    private Button menu;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        requestWindowFeature(Window.FEATURE_NO_TITLE);
        this.getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN,WindowManager.LayoutParams.FLAG_FULLSCREEN);
        setContentView(R.layout.activity_topic);
        listPosts = (ListView) findViewById(R.id.listPost);
        commentBtn = (Button) findViewById(R.id.commentBtn);
        Bundle b = getIntent().getExtras();
        if (b != null) {
            idTopic = b.getInt("idTopic");
            Log.w(TAG, String.valueOf(idTopic));
            List<Post> posts = getPosts(idTopic);
            Post firstPost = posts.get(0);
            posts.remove(0);
            PostsAdapter adapter = new PostsAdapter(this, posts);
            listPosts.setAdapter(adapter);
            menu = (Button) findViewById(R.id.btnMenu);
            menu.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    startActivity(new Intent(TopicActivity.this, MenuActivity.class));
                    overridePendingTransition(R.anim.slide_in_right, R.anim.slide_out_left);
                }
            });


            commentBtn.setOnClickListener(new View.OnClickListener() {

                @Override
                public void onClick(View v) {
                    Intent intent = new Intent(TopicActivity.this, CommentActivity.class);
                    intent.putExtra("idTopic", idTopic);
                    TopicActivity.this.startActivity(intent);
                    overridePendingTransition(R.anim.slide_in_right, R.anim.slide_out_left);
                }
            });
            String titre = getTopic(idTopic);
            sujet = (TextView) findViewById(R.id.sujet);
            sujet.setText(titre.toUpperCase());
            photo = (ImageView) findViewById(R.id.photoAuteur);
            //photo.setImageDrawable(getResources().getDrawable(R.drawable.twitter_oeuf));
            photo.setImageBitmap(ImageLoad.getBitmapFromURL(firstPost.getPicture()));
            content = (TextView) findViewById(R.id.description);
            content.setText(firstPost.getContent());
            date = (TextView) findViewById(R.id.dateTopic);
            date.setText(firstPost.getDate());
        }

    }

    public String getTopic(int id){
        PostDescriptionBackgroundWorker postDescBw = new PostDescriptionBackgroundWorker(this);
        String titre = null;
        try{
            titre = postDescBw.execute(id).get();
        }catch (InterruptedException | ExecutionException e){
            Log.w(TAG, "IterruptedException");
        }
        return titre;

    }


    public List<Post> getPosts(int id){
        PostsBackgroundWorker postsBw = new PostsBackgroundWorker(this);
        List<Post> posts = null;
        try{
            posts =  postsBw.execute(id).get();
        }catch(InterruptedException | ExecutionException e){
        Log.w(TAG, "IterruptedException");
        }

        return posts;
    }
}
