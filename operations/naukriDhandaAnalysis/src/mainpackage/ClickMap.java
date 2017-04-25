package mainpackage;


import java.io.IOException;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

import org.apache.commons.lang3.StringUtils;
import org.apache.hadoop.io.IntWritable;
import org.apache.hadoop.io.LongWritable;
import org.apache.hadoop.io.Text;
import org.apache.hadoop.mapreduce.Mapper;

public class ClickMap extends Mapper<LongWritable, Text, Text, IntWritable>{
	@Override
	protected void map(LongWritable key, Text value, Context context) throws IOException, InterruptedException
	{
		String line = value.toString().trim().replaceAll(",", "").replaceAll("\"", "");
		if(!line.equals(""))
			context.write(new Text(String.valueOf(line)), new IntWritable(1));		
	}
}