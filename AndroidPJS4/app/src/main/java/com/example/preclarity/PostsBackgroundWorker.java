package com.example.preclarity;

import android.content.Context;
import android.os.AsyncTask;
import android.util.Log;

import com.example.preclarity.Forum.Topic;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLEncoder;
import java.util.ArrayList;
import java.util.List;

public class PostsBackgroundWorker extends AsyncTask<Integer, Void, List<Post>> {
    private static final String TAG = "28910" ;
   Context context;

   public PostsBackgroundWorker(Context ctx){
       this.context = ctx;
   }


    @Override
    protected List<Post> doInBackground(Integer... voids) {
       Integer id = voids[0];
       List<Post> posts = new ArrayList<Post>();
        String login_url="http://pjs4.ulyssebouchet.fr/Android/Topic.php";
        String result="";
        try {
            URL url = new URL(login_url);
            HttpURLConnection httpURLConnection = (HttpURLConnection)url.openConnection();
            httpURLConnection.setRequestMethod("POST");
            httpURLConnection.setDoOutput(true);
            httpURLConnection.setDoInput(true);
            OutputStream outputStream = httpURLConnection.getOutputStream();
            BufferedWriter bufferedWriter = new BufferedWriter(new OutputStreamWriter(outputStream, "UTF-8"));
            String post_data = URLEncoder.encode("idTopic","UTF-8")+"="+URLEncoder.encode(String.valueOf(id),"UTF-8");
            bufferedWriter.write(post_data);
            bufferedWriter.flush();
            bufferedWriter.close();
            outputStream.close();
            InputStream inputStream = httpURLConnection.getInputStream();
            BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream,"iso-8859-1"));
           // String result="";
            String line="";
            while((line = bufferedReader.readLine())!= null) {
                result += line;
            }
            bufferedReader.close();
            inputStream.close();
            httpURLConnection.disconnect();

        } catch (MalformedURLException e) {
            Log.w(TAG, "Malformated EXCEPTIOOOOOOOON");
        } catch (IOException e) {
            Log.w(TAG, "IO EXCEPTIOOOOOOOON");
        }

        try {
            String s="";
            JSONArray jArray = new JSONArray(result);
            for(int i =0; i<jArray.length();i++){
                JSONObject json = jArray.getJSONObject(i);
                String pseudo = json.getString("pseudo");
                String content= json.getString("content");
                String date = json.getString("datePost");
                String picture = json.getString("imageProfil");
                Post post = new Post(pseudo,content, date, picture);
                posts.add(post);
            }
            Log.w("PREMIER POST :", posts.get(0).getContent());
            return posts;
            // TopicAdapter adapter = new TopicAdapter(context, lastTopics);

        } catch (JSONException e) {
            e.printStackTrace();
        }

        return null;
    }
}
